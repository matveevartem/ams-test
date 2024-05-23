(function () {
    const NavLogo = document.querySelector('.task-nav .nav-logo');
    const TaskInfo = document.querySelector('#task-info-field');
    const SqlLabel = document.querySelector('#sqlModalLabel');
    const SqlBody = document.querySelector('#sqlModalBody pre');

    document.querySelectorAll('.btn-show-sql').forEach(btn => {
        btn.addEventListener('click', e => {
            let sql = '';
            let label = '';

            switch (e.target.id) {
                case 'btn-sql-1':
                    label = 'SQL для Task 1-1';
                    sql = "\
    SELECT\n\
        mdl.id as modelId,\n\
        mrk.name as markName,\n\
        mdl.name as modelName,\n\
        mdl.date_end as endTime\n\
    FROM car_model mdl\n\
    INNER JOIN car_mark mrk ON (mrk.id = mdl.mark_id)\n\
    WHERE mdl.date_end <= :dateEnd;";
                    break;
                case 'btn-sql-2':
                    label = 'SQL для Task 1-2';
                    sql = "\
SELECT\n\
    mdl.id as modelId,\n\
    mrk.name as markName,\n\
    mdl.name as modelName,\n\
    wrk.name as workName,\n\
    wrk.cost as workCost,\n\
    wrk.time as workTime\n\
FROM car_model mdl\n\
INNER JOIN car_mark mrk ON(mrk.id = mdl.mark_id)\n\
INNER JOIN car_work wrk ON(wrk.model_id = mdl.id)\n\
WHERE NOW() BETWEEN mdl.date_start AND mdl.date_end\n\
AND wrk.cost > :cost;";
                    break;
            }
            SqlLabel.innerHTML = label;
            SqlBody.innerHTML = sql;
        })
    });

    document.querySelectorAll('.btn-car-info').forEach(btn => {
        btn.addEventListener('click', e => {
            let id = btn.id.replace('btn-car-info-','');
            fetch('/car/' + id)
            .then(r => r.json())
            .then(data => {
                if(data['modelId'] !== 'undefined') {
                    let carModalLabel = document.getElementById('carModalLabel');
                    let carInfoModal = document.getElementById('carInfoModal');
                    let carWorkModal = document.getElementById('carWorkModal');

                    carModalLabel.innerHTML = data['bodyTypeName']
                                                + ' '
                                                + data['markName']
                                                + ' '
                                                + data['modelName'];
                    carInfoModal.innerHTML = '';
                    carWorkModal.innerHTML = '';

                    let li = document.createElement('li');
                    li.innerHTML = '<strong>Марка</strong>: ' + data['markName'];
                    carInfoModal.appendChild(li);
                    li = document.createElement('li');
                    li.innerHTML = '<strong>Модель</strong>: ' + data['modelName'];
                    carInfoModal.appendChild(li);
                    li = document.createElement('li');
                    li.innerHTML = '<strong>Тип кузова</strong>: ' + data['bodyTypeName'];
                    carInfoModal.appendChild(li);
                    li = document.createElement('li');
                    li.innerHTML = '<strong>Выпускался</strong>: ' + data['timeStart'] + ' - ' + data['timeEnd'];
                    carInfoModal.appendChild(li);

                    data['works'].forEach(el => {
                        let li = document.createElement('li');
                        li.innerHTML = el['workName'];
                        if (el['workId']) {
                            li.innerHTML += ' - '
                                + el['workCost'] 
                                + ' ('
                                + el['workTime']
                                + ' час.)';
                        }
                        carWorkModal.appendChild(li);
                    });
                } else {
                    document.getElementById('carInfoModal').innerHTML = 'No car found';
                    document.getElementById('carModalLabel').innerHTML = '';
                    document.getElementById('carWorkModal').innerHTML = '';
                }
            })
            .catch(e => {
                console.log(e);
            });
        })
    });

    document.querySelectorAll('.task-menu-item').forEach(menu => {
        menu.addEventListener('click', e => {
            let cls = menu.classList[1];
            let text = menu.getAttribute('body-type');
            NavLogo.innerHTML = menu.innerHTML;

            TaskInfo.innerHTML = text;

            document.querySelectorAll('.task-card').forEach(card => {
                card.hidden = true;
            });

            document.querySelectorAll('.task-card').forEach(card => {
                if (cls === 'body-type-all' || card.classList[1] === cls) {
                    card.hidden = false;
                }
            });
        });
    });
})();