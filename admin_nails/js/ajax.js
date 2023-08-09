const set_company = document.getElementById('set_company');
const set_service = document.getElementById('set_service');
const set_staff = document.getElementById('set_staff');

const staff_id = document.getElementById('staff_id');

let hiddenModal = document.querySelector('.modal-body #set_service');

//Page edit
const inputEditCompany = document.getElementById('edit-company');
const inputEditService = document.getElementById('edit-service');
const inputEditStaff = document.getElementById('edit-staff');

if(!staff_id){
        if(set_company){
            var valueId = set_company.value;

            $.ajax({
                url: 'action/ajax_get_service.php',
                type: 'get',
                dataType: 'json',
                data: {
                    company_id: valueId
                }
            }).done(function (reponse) {
                if(reponse.length > 1 && set_staff){
                    set_staff.innerHTML = ``;
                }
                getService(reponse);

                var service_id = set_service.value;
                if(set_staff){
                    $.ajax({
                        url: 'action/ajax_change_service.php',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            service_id: service_id
                        }
                    }).done(function (reponse) {
                        getStaff(reponse);
                    });
                }
                
            });
        }
}else{
    if(set_company && set_service){

        var valueId = set_company.value;
        var service_id = set_service.value;
    
        if(set_staff){
            $.ajax({
                url: 'action/ajax_change_service.php',
                type: 'get',
                dataType: 'json',
                data: {
                    service_id: service_id
                }
            }).done(function (reponse) {
                getStaff(reponse);
                
            });
        }
        if(set_company, set_service){
            $.ajax({
                url: 'action/ajax_get_service.php',
                type: 'get',
                dataType: 'json',
                data: {
                    company_id: valueId
                }
            }).done(function (reponse) {
                if(reponse.length > 1 && set_staff){
                    set_staff.innerHTML = ``;
                }
                getService(reponse)
            });
        }
    }
}


if(set_company, set_service){
    set_company.addEventListener('change', function(e){
        var valueId = set_company.value;

        e.preventDefault();

        $.ajax({
            url: 'action/ajax_get_service.php',
            type: 'get',
            dataType: 'json',
            data: {
                company_id: valueId
            }
        }).done(function (reponse) {
            if(reponse.length > 1 && set_staff){
                set_staff.innerHTML = "";
            }
            getService(reponse);
            
            var service_id = set_service.value;
            if(set_staff){
                $.ajax({
                    url: 'action/ajax_change_service.php',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        service_id: service_id
                    }
                }).done(function (reponse) {
                    getStaff(reponse);
                });
            }
        });
    })
    set_service.addEventListener('change', function(e){
        var valueId = set_service.value;
        e.preventDefault();

        if(set_staff){
            $.ajax({
                url: 'action/ajax_change_service.php',
                type: 'get',
                dataType: 'json',
                data: {
                    service_id: valueId
                }
            }).done(function (reponse) {
                getStaff(reponse);
            });
        }
    })
}

function getService(reponse){
    set_service.innerHTML = ``;
    reponse.forEach(element => {
        set_service.innerHTML += `
            <option class="divService" value="${element['ID_service']}">${element['name_service']}</option>
        `
        if(inputEditService){
            for (var i = 0; i < document.querySelectorAll('.divService').length; i++) {
                if (document.querySelectorAll('.divService')[i].value == inputEditService.value) {
                    document.querySelectorAll('.divService')[i].selected = true;
                    break;
                }
            }
        }
    });
}
function getStaff(reponse){
    set_staff.innerHTML = ``;
    console.log(reponse);
    reponse.forEach(element => {
        set_staff.innerHTML += `
            <option class="divStaff" value="${element['ID_staff']}">${element['user_name']}</option>
        `
        if(inputEditStaff){
            for (var i = 0; i < document.querySelectorAll('.divStaff').length; i++) {
                if (document.querySelectorAll('.divStaff')[i].value == inputEditStaff.value) {
                    document.querySelectorAll('.divStaff')[i].selected = true;
                    break;
                }
            }
        }
    });
    
}

//Check phone have exits
const phoneCompany = document.querySelector('.phone_company');
const form_company = document.getElementById('form_company');
let PHONE_NUMBER;
let CHECK_PHONE = false;

if(phoneCompany && form_company){
    phoneCompany.addEventListener('keyup', function(event){
        event.preventDefault();
        PHONE_NUMBER = event.target.value;

        $.ajax({
            url: 'ajax_checkphone_company.php',
            type: 'get',
            dataType: 'json',
            data: {
                phone: PHONE_NUMBER
            }
        }).done(function (reponse) {
            if(reponse === true){
                CHECK_PHONE = true;
            }
            else{
                CHECK_PHONE = false;
            }
        });
    })
}

window.addEventListener('load', function(){
    if(form_company){
        form_company.addEventListener('submit', function(event){
            if(CHECK_PHONE === false){
                event.preventDefault();
                phoneCompany.style.border = '1px solid red';
                alert("Phone number have exists")
            }else{
                return true;
            }
        })
    }
})

function validate(){
    if(phoneCompany){
        var regName = /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/;
        var regPhoneVN = /^[0-9]{9,12}$/;
        if(!regName.test(phoneCompany.value) && !regPhoneVN.test(phoneCompany.value)){
            var str = '';
            if(!regName.test(phoneCompany.value)){
                str = 'Phone number must be formattrd in XXX-XXX-XXXX or Vietnamese phone number with 9 to 12 digits';
            }
            if(!regPhoneVN.test(phoneCompany.value)){
                str = 'Phone number must be formattrd in XXX-XXX-XXXX or Vietnamese phone number with 9 to 12 digits';
            }
            alert(str);
            phoneCompany.focus();
            return false;
        }else{
            return true;
        }
    }
}


//Get type when onchange company
const selectCompany = document.getElementById('select-company');
const selectType = document.getElementById('select-type');
const selectService = document.getElementById('select-service');

//Check exist
if(selectCompany && selectType){
    window.addEventListener('load',function(event){
        event.preventDefault();

        let idCom = selectCompany.value;//Get id company in select
        let idEdit = 0;

        if(selectCompany.getAttribute('data-edit')){
            idEdit = selectCompany.dataset.edit;
        }
        getNailTypeByCompany(idCom,idEdit);
    })
    selectCompany.addEventListener('change', function(event){
        event.preventDefault();

        let idCom = selectCompany.value;//Get id company in select
        let idEdit = 0;

        if(selectCompany.getAttribute('data-edit')){
            idEdit = selectCompany.dataset.edit;
        }

        getNailTypeByCompany(idCom,idEdit);
    })
}

//Check exist in list staff
if(selectCompany && selectService){
    window.addEventListener('load',function(event){
        event.preventDefault();

        let idCom = selectCompany.value;//Get id company in select
        let idEdit = 0;

        if(selectCompany.getAttribute('data-edit')){
            idEdit = selectCompany.dataset.edit;
        }
        getServiceByCompany(idCom,idEdit);
        
    })
    selectCompany.addEventListener('change', function(event){
        event.preventDefault();

        let idCom = selectCompany.value;//Get id company in select
        let idEdit = 0;

        if(selectCompany.getAttribute('data-edit')){
            idEdit = selectCompany.dataset.edit;
        }

        getServiceByCompany(idCom,idEdit);
    })

    // selectService.addEventListener('change', function(event){
    //     console.log(selectService.value);
    // })


}

function getNailTypeByCompany(idCom, page){
    $.ajax({
        url: 'ajax_get_typenail.php',
        type: 'get',
        dataType: 'json',
        data: {
            id_company: idCom
        }
    }).done(function(reponse){
        console.log(reponse);
        const selectType = document.getElementById('select-type');
        
        if(selectType){
            selectType.innerHTML = ``;
            selectType.innerHTML = ``;
            
            reponse.forEach(item => {
                selectType.innerHTML += `
                <option class="optionType" value="${item['id']}">${item['type_name']}</option>
                `;
            })

            if(page != 0){
                for (var i = 0; i < document.querySelectorAll('.optionType').length; i++) {
                    if (document.querySelectorAll('.optionType')[i].value == page) {
                        document.querySelectorAll('.optionType')[i].selected = true;
                        break;
                    }
                }
            }
        }
    })
}

//Function get service by company
function getServiceByCompany(idCom, page){
    $.ajax({
        url: 'ajax_get_service.php',
        type: 'get',
        dataType: 'json',
        data: {
            id_company: idCom
        }
    }).done(function(reponse){
        const selectService = document.getElementById('select-service');
        const listLi = document.querySelector('.dropdown-menu div[role=listbox] ul.dropdown-menu')

        if(listLi){
            // selectService.innerHTML = ``;
            listLi.innerHTML = ``;
            reponse.forEach(item => {
                listLi.innerHTML += `
                <li><a data-service="${item['ID_service']}" role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">${item['name_service']}</span></a></li>
                `;
                // <option class="optionType" value="${item['ID_service']}">${item['name_service']}</option>
            })
            $('#select-service').selectpicker();


            const inputListIdSer = document.getElementById('array_service');
            const inputListNameSer = document.getElementById('array_name_service');
            let idSer = '';
            let nameSer = '';
            if(inputListIdSer && inputListNameSer){
                idSer =  JSON.parse(inputListIdSer.value);
                nameSer =  JSON.parse(inputListNameSer.value);
            }

            document.querySelector('.bs-searchbox').style.display = 'none';
            activeMulti(listLi.querySelectorAll('li a'),document.querySelector('button[data-id="select-service"] .filter-option .filter-option-inner-inner'),idSer,nameSer);

            if(page != 0){
                for (var i = 0; i < document.querySelectorAll('.optionService').length; i++) {
                    if (document.querySelectorAll('.optionService')[i].value == page) {
                        document.querySelectorAll('.optionService')[i].selected = true;
                        break;
                    }
                }
            }
        }
    })
}
let titleSelect = [];
let idSelect = [];

function activeMulti(divall,divTitle,arr = '',arrName = ''){
    if(arr != '' && arrName != ''){
        arr.forEach(idSer => {
            idSelect.push(idSer);
        })
        arrName.forEach(nameSer => {
            titleSelect.push(nameSer);
        })
        // const inputList = document.getElementById('listid_service');
        //     if(inputList){
        //         inputList.value = idSelect.toString();
        //     }
        divTitle.textContent = titleSelect.toString();
        const inputList = document.getElementById('listid_service');
            if(inputList){
                inputList.value = idSelect.toString();
            }
    }
    divall.forEach(item => {
        if(arr != '' && arrName != ''){
            
            arr.forEach(idSer => {
                if(item.dataset.service == idSer){
                    item.classList.add('selected');
                }
            })
        }
        

        item.addEventListener('click',function(event){
            event.preventDefault();
            item.classList.toggle('selected');

            const nameSer = item.querySelector('span.text');
            if(item.classList.contains('selected')){
                titleSelect.push(nameSer.textContent);
                idSelect.push(item.dataset.service);
                if(arr == '' && arrName == ''){
                }
            }else{
                removeItemOnce(titleSelect,nameSer.textContent);
                removeItemOnce(idSelect,item.dataset.service);
            }
            const inputList = document.getElementById('listid_service');
            if(inputList){
                inputList.value = idSelect.toString();
            }
            divTitle.textContent = titleSelect.toString();
        })
    })
}


function removeItemOnce(arr, value) {
    for (var i = 0; i < arr.length; i++) {
        if (String(arr[i]) == String(value)) {
            arr.splice(i, 1);
        }
    }
    return arr;
}