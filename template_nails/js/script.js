const list_hour = document.querySelectorAll('.list-hour');
if(list_hour){
    list_hour.forEach(item => {
        var arr = item.querySelectorAll('div');
        arr.forEach(data => {
            data.addEventListener('click', function(){
                clear();
                data.classList.add('active');
                data.querySelector('input[type=radio]').checked = true;
            })
        })
    })
}
function clear(){
    if(list_hour){
        list_hour.forEach(item => {
            var arr = item.querySelectorAll('div');
            arr.forEach(data => {
                data.classList.remove('active');
            })
        })
    }
}


const validName = document.getElementById('valid-name');
const validPhone = document.getElementById('valid-phone');

// if(validPhone){
//     validPhone.addEventListener('keyup', function(event){
//         if(validPhone){
//             // var regName = /^[(][0-9]{3}[)]\s[0-9]{3}-[0-9]{4}$/;
//             var regName = /^\+[8][4][0-9]{9,11}$/;
//             // var regPhoneVN = /^[0-9]{9,12}$/;
//             if(regName.test(validPhone.value)){
//                 validPhone.setCustomValidity("");
//                 validPhone.focus = false;
//             }else{
//                 validPhone.setCustomValidity("Phone number required enter is format  +84xxxxxxxxx.");
//                 // validPhone.setCustomValidity("Phone number required enter is format (XXX) XXX-XXXX. e.g: (123) 123-1234");
//                 validPhone.focus = true;
//                 return false;
//             }
//         }

//     })
// }

if(validPhone){
    validPhone.addEventListener('keyup', function(event){
        limitText(this, 14);
        var regex = /^[0-9]$/;
        if(regex.test(event.key)){
            if(validPhone.value.length == 1){
                validPhone.value = "(" + validPhone.value;
            }
            if(validPhone.value.length == 4){
                validPhone.value = validPhone.value + ') ';
            }
            if(validPhone.value.length == 9){
                validPhone.value = validPhone.value + '-';
            }
            // var regName = /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/;
            var regName = /^[(][0-9]{3}[)]\s[0-9]{3}-[0-9]{4}$/;
            
            // var regPhoneVN = /^[0-9]{9,12}$/;
            if(regName.test(validPhone.value)){//regName
                validPhone.setCustomValidity("");
                validPhone.focus = false;
            }else{
                // validPhone.setCustomValidity("Phone number required enter is format +84xxxxxxxxx.");
                validPhone.setCustomValidity("Phone number required enter is format (XXX) XXX-XXXX. e.g: (123) 123-1234");
                validPhone.focus = true;
                return false;
            }
        }else{
            var result = validPhone.value.substring(0, validPhone.value.length - 1);
            validPhone.value = result;
        }

    })
}
if(validName){
    validName.addEventListener('keyup', function(){
        var regex  = /^[a-zA-Z0-9\s_]*$/;
        if(!regex .test(validName.value)){
            validName.setCustomValidity("Name cannot contain special characters!");
            validName.focus = true;
            return false;
        }else{
            validName.setCustomValidity("");
            validName.focus = false;
        }
    })
}
function validate(){
    if(validPhone && validName){
        var regName = /^[(][0-9]{3}[)]\s[0-9]{3}-[0-9]{4}$/;
        // var regName = /^\+[8][4][0-9]{9,11}$/;
        var regex  = /^[a-zA-Z0-9\s_]*$/;
        // var regPhoneVN = /^[0-9]{9,12}$/;
        if(regName.test(validPhone.value)){
            validPhone.setCustomValidity("");
            validPhone.focus = false;
        }else{
            // validPhone.setCustomValidity("Phone number required enter is format  +84xxxxxxxxx.");
            validPhone.setCustomValidity("Phone number required enter is format (XXX) XXX-XXXX. e.g: (123) 123-1234");
            validPhone.focus = true;
            return false;
        }

        if(!regex .test(validName.value)){
            validName.setCustomValidity("Name cannot contain special characters!");
            validName.focus = true;
            return false;
        }else{
            validName.setCustomValidity("");
            validName.focus = false;
        }

    }

    return true;
}
function limitText(field, maxChar){
    var ref = $(field),
    val = ref.val();
    if ( val.length >= maxChar ){
      ref.val(function() {
        return val.substr(0, maxChar);
      });
    }
 }


//Change color BG
const settingColor = document.querySelector('.setting-color');
const btnSetting = document.querySelector('.setting-color .icon-setting');
const groupBtn = document.querySelectorAll('.setting-color .group-color ul button');

if(btnSetting){
    btnSetting.addEventListener('click', function(){
        settingColor.classList.toggle('active')
    })
}
if(groupBtn){
    groupBtn.forEach(item => {
        item.addEventListener('click', function(event){
            const root = document.querySelector(':root');

            var color = event.target.dataset.color;
            var colorBtn = event.target.dataset.button;
            // set css variable
            root.style.setProperty('--bg-home', color);
            root.style.setProperty('--btn-main', colorBtn);
            root.style.setProperty('--bg-main', colorBtn);

            // Save data in localStorage
            localStorage.setItem('bgColor', color);
            localStorage.setItem('btnColor', colorBtn);
            localStorage.setItem('bgMain', colorBtn);

            // console.log( getComputedStyle(root).getPropertyValue('--bg-main'));
        })
    })
}
window.addEventListener('load', function(event){
    if(localStorage.getItem('bgColor') && localStorage.getItem('btnColor') && localStorage.getItem('bgMain')){
        var root = document.querySelector(':root');
        root.style.setProperty('--bg-home', localStorage.getItem('bgColor'));
        root.style.setProperty('--btn-main', localStorage.getItem('btnColor'));
        root.style.setProperty('--bg-main', localStorage.getItem('bgMain'));
    }
})
//-----------------------------------------------
//-----------------------------------------------
//-----------------------------------------------

let START_DATE_UPDATE;
let START_DATE = new Date();
let MONTH_CLICK;
const myInputDate = document.querySelector('#myInput');
const div_date = document.querySelector('.group-date .list-date');
const list_hours = document.querySelectorAll('.list-date .list-hour');
//---------------Picked up date/month/year---------------//
const btnNextWeek = document.querySelector('.list-date .btn-next');
const btnPreWeek = document.querySelector('.list-date .btn-previous');

const pickup_main = document.querySelector('.pickup-main');
const monthYear = document.querySelector('.month-year b');

const inputStaff = document.getElementById('id_staff');

//Value update date
const dateUpdate = this.document.getElementById('date-update');
const timeUpdate = this.document.getElementById('time-update');

//limit date in mobile
let LIMIT_DATE = 5;
if(div_date){
    div_date.innerHTML = ``;
    if(window.innerWidth < 415){
        for (let i = 0; i < LIMIT_DATE; i++) {
            div_date.innerHTML += `
            <div class="item">
                <div class="info-date">
                    <p class="date-letter">SUN</p>
                    <p class="date-number">01</p>
                    <input type="text" class="month" hidden>
                    <input type="text" class="year" hidden>
                </div>
            </div>
            `;
        }
    }else{
        for (let i = 0; i < 7; i++) {
            div_date.innerHTML += `
            <div class="item">
                <div class="info-date">
                    <p class="date-letter">SUN</p>
                    <p class="date-number">01</p>
                    <input type="text" class="month" hidden>
                    <input type="text" class="year" hidden>
                </div>
            </div>
            `;
        }
    }

    //
window.addEventListener('load', function(evt){
    const arrDate = div_date.querySelectorAll('.item');

    //Show date and time in screen
    if(pickup_main && monthYear && arrDate){
        arrDate.forEach(item => {
            item.addEventListener('click', function(event){
                event.preventDefault();

                clearArrChecked(arrDate);
                item.classList.add('active');

                const inputMonth = item.querySelector('.month');
                const inputYear = item.querySelector('.year');
                monthYear.innerHTML = `${inputMonth.value}, ${inputYear.value}`;
                
                var day = item.querySelector('.date-number').textContent;
                
                var arrTime = monthYear.textContent.split(", ");
                var month = getMonthNumber(arrTime[0]);
                var year = arrTime[1];
                
                var fullDate = `${day}/${month}/${year}`;
                // let dateFormat = `${year}-${month}-${day}`
                myInputDate.value = fullDate;

                var staff_ID = inputStaff.value;

                propressTime(staff_ID);
                
            })
        })


            // window.onload = () => {
                let currentDate = new Date();
                if(dateUpdate && timeUpdate){
                    currentDate = new Date(dateUpdate.value);
                    START_DATE_UPDATE = new Date(dateUpdate.value);
                }else{
                    currentDate = new Date();
                }
                
                START_DATE = currentDate;
                showDate(START_DATE);

                if(btnNextWeek && btnPreWeek){
                    //Button next date
                    btnNextWeek.addEventListener('click', function(event){
                        event.preventDefault();
                        // const currentDate = new Date();
                        if(window.innerWidth < 415){
                            var newDate = new Date(START_DATE.getTime() + 5 * 24 * 60 * 60 * 1000);
                        }else{
                            var newDate = new Date(START_DATE.getTime() + 7 * 24 * 60 * 60 * 1000);
                        }

                        START_DATE = newDate;
                        showDate(newDate);
                    })
                    //Btn previous date
                    btnPreWeek.addEventListener('click', function(event){
                        event.preventDefault();
                        // const currentDate = new Date();
                        if(window.innerWidth < 415){
                            var newDate = new Date(START_DATE.getTime() - 5 * 24 * 60 * 60 * 1000);
                        }else{
                            var newDate = new Date(START_DATE.getTime() - 7 * 24 * 60 * 60 * 1000);
                        }

                        START_DATE = newDate;
                        showDate(newDate);

                    })
                }

                if(myInputDate && inputStaff){
                    if(dateUpdate && timeUpdate){
                        var dateNeed = new Date(dateUpdate.value);
                        var currentDay = dateNeed.getDate() < 10 ? "0" + dateNeed.getDate() : dateNeed.getDate();
                        
                        var currentMonth = (dateNeed.getMonth()+1) < 10 ? `0${dateNeed.getMonth()+1}` : (dateNeed.getMonth()+1);
                        var currentYear = dateNeed.getFullYear();
                    }else{
                        let currentDate = new Date();
                        var currentYear = currentDate.getFullYear();
                        var currentMonth = (currentDate.getMonth()+1) < 10 ? `0${currentDate.getMonth()+1}` : (currentDate.getMonth()+1);
                        var currentDay = currentDate.getDate() < 10 ? "0" + currentDate.getDate() : currentDate.getDate();
                    }
                    let staff_ID = inputStaff.value;
                    
                    myInputDate.value = `${currentDay}/${currentMonth}/${currentYear}`;
                    propressTime(staff_ID);
                }
            // }
        }
    })

    const available = document.querySelector('input[type=checkbox]#available');
    if(available){
        available.addEventListener('change', function(){
    
            const arrTime = document.querySelectorAll('.list-date .list-hour');
            if(arrTime){
                arrTime.forEach(item => {
                    var div = item.querySelectorAll('div');
                    div.forEach(data => {
                        if(data.classList.contains('unactive')){
                            if(available.checked == true){
                                data.style.display = "none";
                            }else{
                                data.style.display = "block";
                            }
                        }
                    })
                })
            }
        })
    }
}


function showDate(date){
    const arrDate = div_date.querySelectorAll('.item');

    let today;
    if(dateUpdate && timeUpdate){
        today = new Date(START_DATE_UPDATE);
    }else{
        today = new Date();
    }
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    let currentDateDF = today.getDate() < 10 ? "0" + today.getDate() : today.getDate();

    let currentDayOfWeek = today.toLocaleDateString('en-US', { weekday: 'short' });
    
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    
    let monthEng = monthNames[currentMonth];
    let strMonthYear = `${monthEng}, ${currentYear}`;

    let month = date.getMonth();
    let year = date.getFullYear();

    let currentMonthName = monthNames[month];

    monthYear.textContent = `${currentMonthName}, ${year}`;
    // console.log(`${day}/${month}/${year}`);
    
    // Create an array to store the dates
    let dates = [];
    let datesNum = [];
    let datesMonth = [];
    let datesYear = [];
    // Loop through each day of the week
    for (let i = 0; i < 7; i++) {
        // Add one day to the current date
        let dateTemp = new Date(date);
        
        dateTemp.setDate(dateTemp.getDate() + i);

        let dayofWeek = dateTemp.toLocaleDateString('en-US', { weekday: 'short' });

        dateTemp = dateTemp < 10 ? "0"+dateTemp : dateTemp;

        let unshowMonth = monthNames[dateTemp.getMonth()];
        let unshowYear = dateTemp.getFullYear();
        // Add the date to the array
        dates.push(dayofWeek);
        datesNum.push(dateTemp.getDate());
        datesMonth.push(unshowMonth);
        datesYear.push(unshowYear);
    }
    
    let options = { weekday: 'short' };
    let shortDayOfWeek = date.toLocaleDateString('en-US', options);

    arrDate.forEach((item, index) => {
        let dateLet = item.querySelector('.date-letter');
        let dateNum = item.querySelector('.date-number');
        
        arrDate[index].querySelector('.date-letter').textContent = dates[index].toUpperCase();
        arrDate[index].querySelector('.date-number').textContent = datesNum[index];
        arrDate[index].querySelector('.month').value = datesMonth[index];
        arrDate[index].querySelector('.year').value = datesYear[index];
        
        dateNum.textContent = dateNum.textContent < 10 ? "0" + dateNum.textContent : dateNum.textContent;
        // console.log(dateNum.textContent);
        // clearArrChecked(arrDate);
        
        if(dateLet.textContent == shortDayOfWeek.toUpperCase() && dateNum.textContent == currentDateDF && monthYear.textContent == strMonthYear){
            item.classList.add('active');

            
            // let arrTime = strMonthYear.split(", ");
            let month = getMonthNumber(arrDate[index].querySelector('.month').value);
            let year = datesYear[index];

            let staff_ID = inputStaff.value;
            myInputDate.value = `${currentDateDF}/${month}/${year}`;
            propressTime(staff_ID);
        }else{
            item.classList.remove('active');
        }
        
    })
    // if(currentDateDF == datesNum[0] && currentDayOfWeek == dates[0] && monthYear.textContent == strMonthYear){
    //     btnPreWeek.classList.add('unshow');
    // }else{
    //     btnPreWeek.classList.remove('unshow');
    // }
}

function clearArrChecked(arrElement){
    arrElement.forEach(data => {
        data.classList.remove('active');
    })
}

//Convert month by number
function getMonthNumber(monthName) {
    const months = {
        "january": '01',
        "february": '02',
        "march": '03',
        "april": '04',
        "may": '05',
        "june": '06',
        "july": '07',
        "august": '08',
        "september": '09',
        "october": '10',
        "november": '11',
        "december": '12'
    };
    return months[monthName.toLowerCase()];
}

function checkCurrentDate(date, arr){
    for (let i = 0; i < arr.length; i++) {
        const element = arr[i];
    }
}


function clearActive(){
    const list_hours1 = document.querySelectorAll('.list-date .list-hour');

    if(list_hours1){
        list_hours1.forEach(item => {
            var div = item.querySelectorAll('div');
            div.forEach(data => {
                data.classList.remove('unactive');
                data.classList.remove('active');
            })
        })
    }
}

function unique(arr) {
    var formArr = arr.sort()
    var newArr = [formArr[0]]
    for (let i = 1; i < formArr.length; i++) {
        if (formArr[i] !== formArr[i - 1]) {
            newArr.push(formArr[i])
        }
    }
    return newArr
}


function propressTime(staff_id) {
    clearActive();
    if (myInputDate && list_hours) {
        // myInput.addEventListener('change', function (e) {

        var dateTemp = myInputDate.value;
        
        var date = dateTemp.slice(0, 2)
        var month = dateTemp.slice(3, 5)
        var year = dateTemp.slice(6, 10)

        var newDate_php = year + "-" + month + "-" + date;

        var today = new Date();
        
        var date_cur = today.getDate() < 10 ? "0" + today.getDate() : today.getDate();
        var month_cur = (today.getMonth()+1) < 10 ? "0" + (today.getMonth()+1) : (today.getMonth()+1);

        var hour = (today.getHours()+1) < 10 ? '0' + (today.getHours()+1) : (today.getHours()+1);

        var curent_date = today.getFullYear()+'-'+month_cur+'-'+date_cur;
        var curent_minute = today.getMinutes() < 10 ? `0${today.getMinutes()}` : today.getMinutes();
        var curent_time = hour + ":" + curent_minute;

        $.ajax({
            url: "ajax_check_date.php",
            type: "get",
            dataType: "json",
            data: {
                staff_id: staff_id,
                date_pick: newDate_php,
            },
        }).done(function (reponse) {
            console.log(newDate_php);
            var newArr = unique(reponse);

             //Value update date
            const dateUpdate = document.getElementById('date-update');
            const timeUpdate = document.getElementById('time-update');
            
            list_hours.forEach(item => {
                
                var input = item.querySelectorAll('input[type=radio]');
                input.forEach(data => {
                    for (let i = 0; i < newArr.length; i++) {
                        if (typeof newArr[i] != 'undefined') {
                            var divInput = data.value.slice(0, 5);
                            
                            var time = newArr[i].slice(0, 5);
                            var am_pm = data.value.slice(-2);
                            if(am_pm == 'PM'){
                                var hour = (data.value.slice(0, 2))*1;
                                if(hour != 12){
                                    var last_hour = (data.value.slice(0, 2))*1 + 12;
                                    var last_minute = (data.value.slice(3, 5));
                                    divInput = last_hour + ":" + last_minute;
                                }
                            }
                            if (time == divInput || newArr[i] == data.value) {
                                data.parentElement.classList.add('unactive');
                            }
                        }
                    }
                    if(newDate_php == curent_date){
                        var divInput = data.value.slice(0, 5);

                        var am_pm = data.value.slice(-2);
                        if(am_pm == 'PM'){
                            var hour = (data.value.slice(0, 2))*1;
                            if(hour != 12){
                                var last_hour = (data.value.slice(0, 2))*1 + 12;
                                var last_minute = (data.value.slice(3, 5));
                                divInput = last_hour + ":" + last_minute;

                            }
                        }
                        if(divInput <= curent_time){
                            data.parentElement.classList.add('unactive');
                        }
                    }
                    
                    if(dateUpdate && timeUpdate){
                        if(data.value == timeUpdate.value){
                            data.parentElement.classList.remove('unactive');
                            data.parentElement.classList.add('active');
                            data.parentElement.classList.add('custom-cursor-on-hover');
                            data.checked = true;
                        }
                        if(curent_date == newDate_php){
                            var divInput = data.value.slice(0, 5);

                            var am_pm = data.value.slice(-2);
                            if(am_pm == 'PM'){
                                var hour = (data.value.slice(0, 2))*1;
                                if(hour != 12){
                                    var last_hour = (data.value.slice(0, 2))*1 + 12;
                                    var last_minute = (data.value.slice(3, 5));
                                    divInput = last_hour + ":" + last_minute;

                                }
                            }
                            if(divInput <= curent_time){
                                data.parentElement.classList.add('unactive');
                            }
                        }
                        
                    }
                })
            })

            if(newDate_php < curent_date){
                list_hour.forEach(list => {
                    let divHours = list.querySelectorAll('input[type=radio]');
                        divHours.forEach(data => {
                            data.parentElement.classList.add('unactive');
                            data.parentElement.classList.remove('active');
                            data.parentElement.classList.remove('custom-cursor-on-hover');

                    })
                })
            }
        });
        // })
    }
}