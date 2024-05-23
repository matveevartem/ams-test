<?php

namespace App\Application\Database;

use App\Domain\Database\IDatabase;
use App\Domain\Database\IMigrate;
use App\Infrastructure\Repository\MigrateRepository;

class Migrate implements IMigrate
{
    private $repository;
    private $implemented = [];

    const MIGRATE_DIR = __DIR__ .
                         DIRECTORY_SEPARATOR .
                         '..' .
                         DIRECTORY_SEPARATOR .
                         '..' .
                         DIRECTORY_SEPARATOR .
                         '..' .
                         DIRECTORY_SEPARATOR .
                         'migrations';
    protected IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
        $this->repository = new MigrateRepository(get_class($this->db));

        $this->getImplemented();
    }

    private function getImplemented()
    {
        $files = scandir(self::MIGRATE_DIR . DIRECTORY_SEPARATOR . 'implemented', SCANDIR_SORT_ASCENDING);

        foreach ($files as $file) {
            if (
                $file !== '.' &&
                $file !== '..' &&
                !is_dir(self::MIGRATE_DIR .
                        DIRECTORY_SEPARATOR .
                        'implemented' .
                        DIRECTORY_SEPARATOR .
                        $file
                ) &&
                preg_match('/\.sql$/', $file)
            ) {
                $this->implemented[] = $file;
            }
        }
    }

    public function up(): bool
    {
        $files = scandir(self::MIGRATE_DIR, SCANDIR_SORT_ASCENDING);

        foreach ($files as $file) {
            if (
                $file !== '.' &&
                $file !== '..' &&
                !is_dir(self::MIGRATE_DIR . DIRECTORY_SEPARATOR . $file) &&
                preg_match('/\.sql$/', $file) &&
                !in_array($file, $this->implemented)
            ) {
                $sql = file_get_contents(self::MIGRATE_DIR . DIRECTORY_SEPARATOR . $file);

                $this->repository->implement($sql);

                file_put_contents(self::MIGRATE_DIR . 
                        DIRECTORY_SEPARATOR . 
                        'implemented' . 
                        DIRECTORY_SEPARATOR .
                        $file,
                    ''
                );
            }
        }

        return true;
    }
}
