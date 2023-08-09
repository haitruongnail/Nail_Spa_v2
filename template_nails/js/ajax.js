const GUEST = document.getElementById("guest");
const GUEST2 = document.getElementById("guest2");

const services = document.querySelectorAll(".filter-service");
const services_toggle = document.querySelectorAll(".filter-service2");

const divOption = document.querySelectorAll('.nice-select .option');
const divOption2 = document.querySelectorAll('#guest2 ~ .nice-select .option');

const card_staff = document.querySelector('.list-staff');
const card_staff2 = document.querySelector('.list-staff2');

const guest_com = document.getElementById('guest_com');
const company_active = document.querySelector('.company-active');

const guest_com_toggle = document.getElementById('guest_com_toggle');

let ID_COMPANY;
let ID_STAFF = 0;
let ID_SERVICE;

let ID_STAFF_TOGGLE;
let ID_COMPANY_TOGGLE;
let ID_SERVICE_TOGGLE;

let company_name;
let phone_com;
let address_com;
let time_start_com;
let time_end_com;

window.addEventListener("load", function (e) {
    if(guest_com && guest_com.value != ''){
        var idCompany = guest_com.value;
        ID_COMPANY = idCompany;
        e.preventDefault();

        $.ajax({
            url: "ajax_show_service.php",
            type: "get",
            dataType: "json",
            data: {
                company_id: idCompany,
            },
        }).done(function (reponse) {
            company_name = reponse[0]['company_name'];
            phone_com = reponse[0]['hotline'];
            address_com = reponse[0]['address'];
            time_start_com = reponse[0]['time_start'];
            time_end_com = reponse[0]['time_end'];
            if(company_active){
                company_active.querySelector('.name_com').innerHTML = company_name;
                company_active.querySelector('.phone').innerHTML = phone_com;
                company_active.querySelector('.address').innerHTML = address_com;
                // company_active.querySelector('.time_start').innerHTML = time_start_com.slice(0,5);
                // company_active.querySelector('.time_end').innerHTML = time_end_com.slice(0,5);
            }
            setContentService(reponse);
        });
    }
    if (GUEST && services) {
        var idCompany = GUEST.value;
        ID_COMPANY = idCompany;
        e.preventDefault();

        $.ajax({
            url: "ajax_show_service.php",
            type: "get",
            dataType: "json",
            data: {
                company_id: idCompany,
            },
        }).done(function (reponse) {
            setContentService(reponse)
        });
    }

    if (divOption) {
        divOption.forEach(item => {
            item.addEventListener('click', function (event) {
                var idCompany = event.target.dataset.value;
                ID_COMPANY = idCompany;

                event.preventDefault();

                $.ajax({
                    url: "ajax_show_service.php",
                    type: "get",
                    dataType: "json",
                    data: {
                        company_id: idCompany,
                    },
                }).done(function (reponse) {
                    setContentService(reponse)
                });
            })
        })
    }
    if (divOption2) {
        if(guest_com_toggle){
            var idCompany = guest_com_toggle.value;
            ID_COMPANY = idCompany;

            $.ajax({
                url: "ajax_show_service.php",
                type: "get",
                dataType: "json",
                data: {
                    company_id: idCompany,
                },
            }).done(function (reponse) {
                setContentService2(reponse)
            });
        }else{
            divOption2.forEach(item => {
                item.addEventListener('click', function (event) {
                    var idCompany = event.target.dataset.value;
                    ID_COMPANY = idCompany;
                    event.preventDefault();
    
                    $.ajax({
                        url: "ajax_show_service.php",
                        type: "get",
                        dataType: "json",
                        data: {
                            company_id: idCompany,
                        },
                    }).done(function (reponse) {
                        setContentService2(reponse)
                    });
                })
            })
        }
        
    }

    if (card_staff) {
        card_staff.innerHTML = `<div class="text-center"><h3>Please select a service in the previous tab!</h3></div>`;

    }

    const myBtn = this.document.getElementById('myBtn');
    if (myBtn) {
        myBtn.addEventListener('click', function () {
            if (GUEST2) {
                var idCompany2 = GUEST2.value;
                ID_COMPANY = idCompany2;
                e.preventDefault();

                $.ajax({
                    url: "ajax_show_service.php",
                    type: "get",
                    dataType: "json",
                    data: {
                        company_id: idCompany2,
                    },
                }).done(function (reponse) {
                    setContentService2(reponse)
                });
            }
        })
    }
});

/**Function get service by type id */
function getServiceByType(type_id, company_id, index) {
    $.ajax({
        url: "ajax_show_allservice.php",
        type: "get",
        dataType: "json",
        data: {
            type_id: type_id,
            company_id: company_id
        },
    }).done(function (reponse) {
        var divSelect = document.getElementById(`multiCollapseExample${index}`);
        divSelect.innerHTML = '';
        reponse.forEach(item => {
            var time = item['time_completion'];
            hour = time.slice(0, 2);
            minute = time.slice(3, 5);
            divSelect.innerHTML += `
            <div class="row" onclick="checkedInput(event, ${item['ID_service']});">
                <div class="col-12">
                    <div class="item-service ">
                        <div class="desc-left" onclick="thisInputShowStaff(event, ${item['ID_service']});">
                            <p>${item['name_service']}</p>
                            <p><i class='bx bx-time-five'></i> ${hour} hours ${minute}
                                minutes <span class="space">.</span> <span class="price">$${item['price']}</span></p>
                        </div>
                        <div class="desc-right">
                            <input class"check_staff" type="radio" name="services" onclick="thisInputShowStaff(event, ${item['ID_service']});">
                        </div>
                    </div>
                </div>
            </div>
            `;
        })
    });
}
function getServiceByType2(type_id, company_id, index) {
    $.ajax({
        url: "ajax_show_allservice.php",
        type: "get",
        dataType: "json",
        data: {
            type_id: type_id,
            company_id: company_id
        },
    }).done(function (reponse) {
        var divSelect = document.getElementById(`services${index}`);
        divSelect.innerHTML = '';

        reponse.forEach(item => {
            var time = item['time_completion'];
            hour = time.slice(0, 2);
            minute = time.slice(3, 5);
            divSelect.innerHTML += `
            <div class="row" onclick="showStaffByid(event, ${item['ID_service']});">
                <div class="col-12">
                    <div class="item-service">
                        <div class="desc-left" onclick="showStaffByid(event, ${item['ID_service']});">
                            <p>${item['name_service']}</p>
                            <p><i class='bx bx-time-five'></i> ${hour} hours ${minute}
                                minutes <span class="space">.</span> <span class="price">$${item['price']}</span></p>
                        </div>
                        <div class="desc-right">
                            <input type="radio" name="services" onclick="showStaffByid(event, ${item['ID_service']});">
                        </div>
                    </div>
                </div>
            </div>
            `;
        })
    });
}

//Function checked input when click any point in div service
function thisInputShowStaff(event,id_service){
    ID_STAFF = 0;
    var divParent = event.target.parentElement;
    var parent2 = divParent.parentElement;
    var input = parent2.querySelector('input[type=radio]');

    ID_SERVICE_TOGGLE = id_service;

    if (input) {
        input.checked = true;
    }
        $.ajax({
            url: "ajax_show_staff.php",
            type: "get",
            dataType: "json",
            data: {
                company_id: ID_COMPANY,
                service_id: id_service
            },
        }).done(function (reponse) {
            changeTab();
            card_staff.innerHTML = ``;
            if (reponse == '') {
                card_staff.innerHTML = `
                    <div class="text-center"><h3>Not found staff your need!</h3></div>
                `
            }else{
                reponse.forEach(item => {
                    card_staff.innerHTML += `
                    <div class="card-staff" data-staff="${item['id']}">
                        <div class="card-item card-left">
                            <div class="d-flex align-items-center">
                                <img src="./img/staff/${item['avatar']}" width="70px" height="70px" alt="${item['avatar']}">
                                <p class="name ml-3">${item['user_name']}</p>
                            </div>
                        </div>

                    </div>
                    `;
                    // <a onclick="showCart(${item['id']});" class="btn btn-primary text-white">BOOK</a>
                })
                card_staff.innerHTML += `
                <div class="footer-end my-5">
                    <div class="group-btn">
                        <a id="back-tab-service" onclick="backService();" class="back">Back</a>
                        <a id="next-step-date" href="ajax_select_date.php?id=${ID_COMPANY}&staff=${ID_STAFF}">Continue</a>
                    </div>
                </div>
                `;

                var aDiv = `
                    <div class="card-staff" id="any-staff">
                        <div class="card-item card-left">
                            <div class="d-flex align-items-center">
                                <img src="./img/staff/male-avatar 1.png" width="70px" height="70px" alt="">
                                <p class="name ml-3">Any Staff</p>
                            </div>
                        </div>
                        
                    </div>
                `;
                card_staff.insertAdjacentHTML("afterbegin", aDiv);
            }
            activeStaff()
        });
    //     <div class="card-item card-right">
                            
    //     <a href="ajax_select_date.php?id=${item['company_id']}&staff=${item['id']}" class="btn btn-primary text-white">BOOK</a>
    // </div>
}
function checkedInput(event, id_service) {
    ID_STAFF = 0;
    ID_SERVICE_TOGGLE = id_service;
    
    var input = event.target.querySelector('input[type=radio]');
    if (input) {
        input.checked = true;
        $.ajax({
            url: "ajax_show_staff.php",
            type: "get",
            dataType: "json",
            data: {
                company_id: ID_COMPANY,
                service_id: id_service
            },
        }).done(function (reponse) {
            changeTab();
            card_staff.innerHTML = ``;
            if (reponse == '') {
                card_staff.innerHTML = `
                    <div class="text-center"><h3>Not found staff your need!</h3></div>
                `
            }else{
                reponse.forEach(item => {
                    card_staff.innerHTML += `
                    <div class="card-staff" data-staff="${item['id']}">
                        <div class="card-item card-left">
                            <div class="d-flex align-items-center">
                                <img src="./img/staff/${item['avatar']}" width="70px" height="70px" alt="${item['avatar']}">
                                <p class="name ml-3">${item['user_name']}</p>
                            </div>
                        </div>
                        
                    </div>
                    `;
                })
                
                card_staff.innerHTML += `
                <div class="footer-end my-5">
                    <div class="group-btn">
                        <a id="back-tab-service" onclick="backService();" class="back">Back</a>
                        <a id="next-step-date" href="ajax_select_date.php?id=${ID_COMPANY}&staff=${ID_STAFF}">Continue</a>
                    </div>
                </div>
                `;
                // `<a onclick="setStaffAndDate();" class="btn btn-addmore"><i class='bx bx-plus'></i> Choose any staff</a>`
                var aDiv = `
                    <div class="card-staff" id="any-staff">
                        <div class="card-item card-left">
                            <div class="d-flex align-items-center">
                                <img src="./img/staff/male-avatar 1.png" width="70px" height="70px" alt="">
                                <p class="name ml-3">Any Staff</p>
                            </div>
                        </div>
                        
                    </div>
                `;
                card_staff.insertAdjacentHTML("afterbegin", aDiv);
            }
            activeStaff()
        });
    }
    // <div class="card-item card-right">
    // <a href="ajax_select_date.php?id=${item['company_id']}&staff=${item['id']}">Continue</a>
    //     <a href="ajax_select_date.php?id=${item['company_id']}&staff=${item['id']}" class="btn btn-primary text-white">BOOK</a>
    // </div>
}

function activeStaff(){
    if(card_staff){
        var nextStep = document.getElementById('next-step-date');
        var any_staff = document.getElementById('any-staff');

        if(nextStep){
            if(ID_STAFF == 0){
                nextStep.style.pointerEvents = 'none';
                nextStep.style.opacity = '0.5';
            }
        }

        // choose_any_staff.php?id=${ID_COMPANY}&type_id=${ID_SERVICE_TOGGLE}

        var staffItem = card_staff.querySelectorAll('.card-staff');
        
        staffItem.forEach(item => {
            item.addEventListener('click', function(event){
                clearActiveStaff();
                item.classList.add('active');
                ID_STAFF = item.dataset.staff;
                if(nextStep){
                    if(ID_STAFF != 0){
                        nextStep.style.pointerEvents = 'visible';
                        nextStep.style.opacity = '1';
                    }
                    let classAny = any_staff.classList.contains('active');

                    if(any_staff && classAny){
                        nextStep.setAttribute('href', `choose_any_staff.php?id=${ID_COMPANY}&type_id=${ID_SERVICE_TOGGLE}`)
                    }else{
                        nextStep.setAttribute('href', `ajax_select_date.php?id=${ID_COMPANY}&staff=${ID_STAFF}`)
                    }
                }
                
            })
        })
    }
}
function clearActiveStaff(){
    if(card_staff){
        var staffItem = card_staff.querySelectorAll('.card-staff');
        staffItem.forEach(item => {
            item.classList.remove('active');
        })
    }
}

function backService(){
    const btnBack = document.getElementById('back-tab-service');
    if(btnBack){
        var tabPillService = document.querySelector('.card-booking .nav-tabs li:first-child a');
        var tabPillStaff = document.querySelector('.card-booking .nav-tabs li:last-child a');

        var tabCtnService = document.querySelector('.card-booking .tab-content #home');
        var tabCtnStaff = document.querySelector('.card-booking .tab-content #menu1');

        tabPillStaff.classList.remove('active');
        tabPillService.classList.add('active');

        tabCtnStaff.classList.remove('active');
        tabCtnStaff.classList.remove('show');
        tabCtnService.classList.add('active');
        tabCtnService.classList.add('show');
    }
}

function showStaffByid(event, id_service) {
    var input = event.target.querySelector('input[type=radio]');
    var parent_toggle = event.target.parentElement;
    var parent_toggle_big = parent_toggle.parentElement;

    if(parent_toggle_big.classList.contains('item-service')){
        var input_parent = parent_toggle_big.querySelector('input[type=radio]');
        if(input_parent){
            input_parent.checked = true;
        }
    }
    if(input){
        input.checked = true;
    }
        $.ajax({
            url: "ajax_show_staff.php",
            type: "get",
            dataType: "json",
            data: {
                company_id: ID_COMPANY,
                service_id: id_service
            },
        }).done(function (reponse) {
            changeTab();
            card_staff2.innerHTML = ``;
            if (reponse == '') {
                card_staff2.innerHTML = `
                    <div class="text-center"><h3>Not found staff your need!</h3></div>
                `
            }
            reponse.forEach(item => {
                card_staff2.innerHTML += `
                <div class="card-staff" onclick="activeInput(event);">
                    <div class="card-item card-left">
                        <div class="d-flex align-items-center">
                            <img src="./img/staff/${item['avatar']}" width="70px" height="70px" alt="${item['avatar']}">
                            <p class="name ml-3">${item['user_name']}</p>
                        </div>
                    </div>
                    <div class="card-item card-right">
                        <input type="radio" name="staff-orther" value="${item['id']}" class="custom-cursor-default-hover">
                    </div>
                </div>
                `;
            })
        });
}
function activeInput(event) {
    var input = event.target.querySelector('input[type=radio]');
    if (input) {
        input.checked = true;
        ID_STAFF_TOGGLE = input.value;
    }
}

function setContentService(reponse) {
    services.forEach((item) => {
        item.innerHTML = "";
        reponse.forEach((element, index) => {
            item.innerHTML += `
            <div class="collapse-item">
                    <a data-toggle="collapse" href="#multiCollapseExample${index}" role="button" aria-expanded="false" aria-controls="multiCollapseExample${index}"
                    onclick="getServiceByType(${element['type_id']},${element['company_id']},${index});">
                        <span>${element['type_name']}</span>
                        <span class="float-right"><i class='bx bx-chevron-down'></i></span>
                    </a>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse" id="multiCollapseExample${index}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="item-service ">
                                            <div class="desc-left">
                                                <p>${element['name_service']}</p>
                                                <p><i class='bx bx-time-five'></i> 01 hours 30
                                                    minutes <span class="space">.</span> <span class="price">$20</span></p>
                                            </div>
                                            <div class="desc-right">
                                                <input type="radio" name="services" onclick="getServiceByType(${element['type_id']},${element['company_id']},${index});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
    });
}
function setContentService2(reponse) {
    services_toggle.forEach((item) => {

        item.innerHTML = "";
        reponse.forEach((element, index) => {
            item.innerHTML += `
            <div class="collapse-item">
                    <a data-toggle="collapse" href="#services${index}" role="button" aria-expanded="false" aria-controls="services${index}"
                    onclick="getServiceByType2(${element['type_id']},${element['company_id']},${index});">
                        <span>${element['type_name']}</span>
                        <span class="float-right"><i class='bx bx-chevron-down'></i></span>
                    </a>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse" id="services${index}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="item-service">
                                            <div class="desc-left">
                                                <p>${element['name_service']}</p>
                                                <p><i class='bx bx-time-five'></i> 01 hours 30
                                                    minutes <span class="space">.</span> <span class="price">$20</span></p>
                                            </div>
                                            <div class="desc-right">
                                                <input type="radio" name="services" onclick="getServiceByType2(${element['type_id']},${element['company_id']},${index});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
    });
}

const tabService = document.querySelector('.card-booking ul li:nth-child(1) a');
const contentTabService = document.querySelector('.tab-content #home');
const contentTabService2 = document.querySelector('.tab-content #home2');

const tabStaff = document.querySelector('.card-booking ul li:nth-child(2) a');
const contentTabStaff = document.querySelector('.tab-content #menu1');
const contentTabStaff2 = document.querySelector('.tab-content #menu3');

function changeTab(){
    if(tabService && contentTabService && tabStaff && contentTabStaff){
        tabService.classList.remove('active');
        tabStaff.classList.add('active');
        contentTabService.classList.remove('active');
        contentTabService.classList.remove('show');
        contentTabStaff.classList.add('active');
        contentTabStaff.classList.add('show');
    }
    if(tabService && contentTabService2 && tabStaff && contentTabStaff2){
        tabService.classList.remove('active');
        tabStaff.classList.add('active');
        contentTabService2.classList.remove('active');
        contentTabService2.classList.remove('show');
        contentTabStaff2.classList.add('active');
        contentTabStaff2.classList.add('show');
    }
}

/**
 * Get booking for user
 */
const schedule = document.querySelector('.schedule-main');
const cardStaff = document.querySelectorAll('.card-staff');
const booking = document.querySelector('.booking-main');
const show_cart = document.getElementById('show_cart_user');
// if (show_cart) {
//     show_cart.addEventListener('click', function (e) {
//         if (booking, schedule) {
//             booking.classList.remove('unshow');
//             booking.classList.add('active');
//             schedule.classList.remove('active');
//             schedule.classList.add('unshow');
//         }
//     })
// }

const cart = document.querySelector('.schedule-main .list-card');

function showCart(staff_id) {

        $.ajax({
            url: "ajax_toggle_cart.php",
            type: "post",
            dataType: "json",
            data: {
                staff_id: staff_id
            },
        }).done(function (reponse) {
            if (cart) {
                cart.innerHTML = '';
                reponse.forEach(item => {
                    var time = item['time_completion'];
                    hour = time.slice(0, 2);
                    minute = time.slice(3, 5);
                    cart.innerHTML += `
                    <div class="schedule-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="left">
                                <p class="name">${item['type_name']} $ ${item['name_service']} <i class='bx bx-time-five'></i> ${item['date_duration']} ${item['time_duration']}</p>
                                <p><i class='bx bx-time-five'></i> ${hour} hours ${minute}
                                    minutes <span class="space">.</span> <span class="price">$${item['price']}</span></p>
                                <p class="user"><i class='bx bx-user'></i> ${item['user_name']}</p>
                            </div>
                            <div class="right">
                                <div onclick="deleteCart(${item['staff_id']},${item['company_id']},${item['service_id']},'${item['date_duration']}','${item['time_duration']}');" class="btn-delete">Delete</div>
                            </div>
                        </div>
                    </div>
                    `;
                })
            }
        });
}

function checkStaffChoose() {
    // showCart(ID_STAFF_TOGGLE);
    window.location.href = `ajax_select_date.php?id=${ID_COMPANY}&staff=${ID_STAFF_TOGGLE}`;
    modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if(modal){
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}
function setStaffAndDate(){
    window.location.href = `choose_any_staff.php?id=${ID_COMPANY}&type_id=${ID_SERVICE_TOGGLE}`;
}

//Function delete services into cart
function deleteCart(staff_id, company_id, service_id,date_duration, time) {
    $.ajax({
        url: "ajax_delete_cart.php",
        type: "get",
        dataType: "json",
        data: {
            staff_id: staff_id,
            company_id: company_id,
            service_id: service_id,
            date_duration: date_duration,
            time_duration: time
        },
    }).done(function (reponse) {
        console.log(date_duration);
        if (cart) {
            cart.innerHTML = '';
            reponse.forEach(item => {
                var time = item['time_completion'];
                hour = time.slice(0, 2);
                minute = time.slice(3, 5);
                cart.innerHTML += `
                <div class="schedule-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="left">
                            <p class="name">${item['type_name']} $ ${item['name_service']} <i class='bx bx-time-five'></i> ${item['date_duration']} ${item['time_duration']}</p>
                            <p><i class='bx bx-time-five'></i> ${hour} hours ${minute}
                                minutes <span class="space">.</span> <span class="price">$${item['price']}</span></p>
                            <p class="user"><i class='bx bx-user'></i> ${item['user_name']}</p>
                        </div>
                        <div class="right">
                            <a class="btn-update" href="./select_date.php?id=${item['company_id']}&staff_id=${item['staff_id']}&date=${item['date_duration']}&time=${item['time_duration']}">Update</a>
                            <div onclick="deleteCart(${item['staff_id']},${item['company_id']},${item['service_id']},'${item['date_duration']}','${item['time_duration']}');" class="btn-delete">Delete</div>
                        </div>
                    </div>
                </div>
                `;
            })
        }
    });
}

//Function update services into cart
function updateCart(staff_id, company_id, service_id,date_duration, time) {
    $.ajax({
        url: "ajax_delete_cart.php",
        type: "get",
        dataType: "json",
        data: {
            staff_id: staff_id,
            company_id: company_id,
            service_id: service_id,
            date_duration: date_duration,
            time_duration: time
        },
    }).done(function (reponse) {
        console.log(date_duration);
        if (cart) {
            cart.innerHTML = '';
            reponse.forEach(item => {
                var time = item['time_completion'];
                hour = time.slice(0, 2);
                minute = time.slice(3, 5);
                cart.innerHTML += `
                <div class="schedule-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="left">
                            <p class="name">${item['type_name']} $ ${item['name_service']} <i class='bx bx-time-five'></i> ${item['date_duration']} ${item['time_duration']}</p>
                            <p><i class='bx bx-time-five'></i> ${hour} hours ${minute}
                                minutes <span class="space">.</span> <span class="price">$${item['price']}</span></p>
                            <p class="user"><i class='bx bx-user'></i> ${item['user_name']}</p>
                        </div>
                        <div class="right">
                            <a class="btn-update" href="./select_date.php?id=${item['company_id']}&staff_id=${item['staff_id']}&date=${item['date_duration']}&time=${item['time_duration']}">Update</a>
                            <div onclick="deleteCart(${item['staff_id']},${item['company_id']},${item['service_id']},'${item['date_duration']}','${item['time_duration']}');" class="btn-delete">Delete</div>
                        </div>
                    </div>
                </div>
                `;
            })
        }
    });
}

// Get the modal
var modal = document.getElementById("newModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.querySelectorAll(".close");

if (modal && btn && span) {
    if (modal.dataset.display == 'true') {
        modal.style.display = 'block'
    } else if (modal.dataset.display == 'false') {
        modal.style.display = 'none'
    }


    // When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.forEach(item => {
        item.onclick = function () {
            if (item.dataset.modal == 'close') {
                modal.style.display = "none";
            }
        }

    })
}

/**
 * Ajax select frame time in value data of change
 */

$('#myInput').datepicker({
    format: 'dd/mm/yyyy',
    startDate: "-0d",
    todayBtn: true,
    autoclose: true,
});
// const myInputDate = document.querySelector('#myInput');
// const list_hours = document.querySelectorAll('.list-date .list-hour');
// let DATE_INPUT = '';

// const inputStaff = document.getElementById('id_staff');
// window.addEventListener('load', function(event){
//     if(myInputDate && inputStaff){
//         var staff_ID = inputStaff.value;
//         var currentDate = new Date();
//         var currentYear = currentDate.getFullYear();
//         var currentMonth = (currentDate.getMonth()+1) < 10 ? "0" + (currentDate.getMonth()+1) : (currentDate.getMonth()+1);
//         var currentDay = currentDate.getDate() < 10 ? "0" + currentDate.getDate() : currentDate.getDate();
//         myInputDate.value = `${currentDay}/${currentMonth}/${currentYear}`;
//         DATE_INPUT = `${currentYear}-${currentMonth}-${currentDay}`;

//         propressTime(staff_ID);
//     }
// })

// function propressTime(staff_id) {
//     clearActive();
//     if (myInputDate && list_hours) {
//         // myInput.addEventListener('change', function (e) {

//         var dateTemp = myInputDate.value;
//         var date = dateTemp.slice(0, 2)
//         var month = dateTemp.slice(3, 5)
//         var year = dateTemp.slice(6, 10)

//         var newDate_php = year + "-" + month + "-" + date;
//         var today = new Date();

//         var date_cur = today.getDate() < 10 ? "0" + today.getDate() : today.getDate();
//         var month_cur = (today.getMonth()+1) < 10 ? "0" + (today.getMonth()+1) : (today.getMonth()+1);

//         var hour = (today.getHours()+1) < 10 ? '0' + (today.getHours()+1) : (today.getHours()+1);

//         var curent_date = today.getFullYear()+'-'+month_cur+'-'+date_cur;
//         var curent_time = hour + ":" + today.getMinutes();

//         $.ajax({
//             url: "ajax_check_date.php",
//             type: "get",
//             dataType: "json",
//             data: {
//                 staff_id: staff_id,
//                 date_pick: newDate_php,
//             },
//         }).done(function (reponse) {
//             var newArr = unique(reponse);
//             list_hours.forEach(item => {
                
//                 var input = item.querySelectorAll('input[type=radio]');
//                 input.forEach(data => {
//                     for (let i = 0; i < newArr.length; i++) {
//                         if (typeof newArr[i] != 'undefined') {
//                             var divInput = data.value.slice(0, 5);
                            
//                             var time = newArr[i].slice(0, 5);
//                             var am_pm = data.value.slice(-2);
//                             if(am_pm == 'PM'){
//                                 var hour = (data.value.slice(0, 2))*1;
//                                 if(hour != 12){
//                                     var last_hour = (data.value.slice(0, 2))*1 + 12;
//                                     var last_minute = (data.value.slice(3, 5));
//                                     divInput = last_hour + ":" + last_minute;
//                                 }
//                             }
//                             if (time == divInput || newArr[i] == data.value) {
//                                 data.parentElement.classList.add('unactive');
//                             }
//                         }
//                     }
//                     if(newDate_php == curent_date){
//                         var divInput = data.value.slice(0, 5);

//                         var am_pm = data.value.slice(-2);
//                         if(am_pm == 'PM'){
//                             var hour = (data.value.slice(0, 2))*1;
//                             if(hour != 12){
//                                 var last_hour = (data.value.slice(0, 2))*1 + 12;
//                                 var last_minute = (data.value.slice(3, 5));
//                                 divInput = last_hour + ":" + last_minute;

//                             }
//                         }
//                         if(divInput <= curent_time){
//                             data.parentElement.classList.add('unactive');
//                         }
//                     }
//                 })
//             })
//         });
//         // })
//     }
// }

// function clearActive(){
//     const list_hours1 = document.querySelectorAll('.list-date .list-hour');

//     if(list_hours1){
//         list_hours1.forEach(item => {
//             var div = item.querySelectorAll('div');
//             div.forEach(data => {
//                 data.classList.remove('unactive');
//             })
//         })
//     }
// }

// function unique(arr) {
//     var formArr = arr.sort()
//     var newArr = [formArr[0]]
//     for (let i = 1; i < formArr.length; i++) {
//         if (formArr[i] !== formArr[i - 1]) {
//             newArr.push(formArr[i])
//         }
//     }
//     return newArr
// }


//Search service
const search = document.getElementById('search-service');

if(search){
    search.addEventListener('keyup', function(event){
        var keyword = event.target.value;
        $.ajax({
            url: "ajax_search_service.php",
            type: "get",
            dataType: "json",
            data: {
                com_id: ID_COMPANY,
                keyword: keyword,
            },
        }).done(function (reponse) {
            setContentService(reponse)
        })
    })
}