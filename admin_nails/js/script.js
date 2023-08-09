
// Get the modal
var modal = document.getElementById("newModal");
var modalService = document.getElementById("modalService");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");
var myBtnService = document.getElementById("myBtnService");

// Get the <span> element that closes the modal
var span1 = document.querySelectorAll(".close1");
var span = document.querySelectorAll(".close");

if(modal && btn && span){
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
        item.onclick = function (event) {
            if (item.dataset.modal == 'close') {
                modal.style.display = "none";
            }
        }
    
    })
}
if(modalService && myBtnService && span1){
    if (modalService.dataset.display == 'true') {
        modalService.style.display = 'block'
    } else if (modalService.dataset.display == 'false') {
        modalService.style.display = 'none'
    }
    
    
    // When the user clicks the button, open the modal 
    myBtnService.onclick = function () {
        modalService.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span1.forEach(item => {
        item.onclick = function () {
            if (item.dataset.modal == 'close') {
                modalService.style.display = "none";
            }
        }
    
    })
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modalService) {
        modalService.style.display = "none";
    }
    if (event.target == modal) {
        modal.style.display = "none";
    }
    
}


const validName = document.getElementById('valid-name');
const validPhone = document.getElementById('valid-phone');

function validate(){
    if(validPhone){
        var regName = /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/;
        // var regPhoneVN = /^[0-9]{9,12}$/;
        if(!regName.test(validPhone.value)){
            var str = 'Phone number must be formattrd in XXX-XXX-XXXX';
            // if(!regPhoneVN.test(validPhone.value)){
            //     str = 'Phone number must be formattrd in XXX-XXX-XXXX or Vietnamese phone number with 9 to 12 digits';
            // }
            alert(str);
            return false;
        }

        
        if(validName){
            let valueName = validName.value;
            let arr = valueName.split(" ").filter(s => s!== "");
            if(arr.length != 2){
                validName.focus = true;
                alert("Full name included first name and last name. e.g. John Devid");
                return false;
            }else{
                validName.focus = false;
            }
        }
    }

    return true;
}

//=========================Delete span ===============================//
const groupSpam = document.querySelector('.group-spam');
const checkbox = document.querySelectorAll('.checkbox-delete');

let ARR_BOOKING = [];//Array lists input checkbox item delete

if(groupSpam && checkbox){
    const optionSpam = groupSpam.querySelector('#delete-spam');
    const btnSubmit = groupSpam.querySelector('button[type=submit]');

    optionSpam.addEventListener('change', function(event){
        event.preventDefault();

        if(optionSpam.value == "delete_all"){
            btnSubmit.disabled = false;//Active button submit

            checkbox.forEach(item => {
                item.classList.remove('active');//Hidden checkbox delete item
            })


        }else if(optionSpam.value == "selelct_item"){

            if(ARR_BOOKING.length == 0){
                btnSubmit.disabled = true;
            }else{
                btnSubmit.disabled = false;
            }
            checkbox.forEach(item => {
                item.classList.add('active');
            })
            
            //Hidden or show button submit depending on whether it's worth it or not
            if(ARR_BOOKING.length > 0){
                btnSubmit.disabled = false;
            }else{
                btnSubmit.disabled = true;
            }
        }
    })
    
    checkbox.forEach(item => {
        item.addEventListener('click', function(event){
            if(event.target.checked == true){
                ARR_BOOKING.push(event.target.value);//push value item booking in array

            }else{
                for (let i = 0; i < ARR_BOOKING.length; i++) {
                    if(ARR_BOOKING[i] == event.target.value){
                        ARR_BOOKING.splice(i, 1);//Remove value in array if this input unchecked
                    }
                }
            }
            
            //Hidden or show button submit depending on whether it's worth it or not
            if(ARR_BOOKING.length > 0){
                btnSubmit.disabled = false;
            }else{
                btnSubmit.disabled = true;
            }

            const arrayItems = groupSpam.querySelector('input#array_items');//Get input tag to attach value
            if(arrayItems){
                arrayItems.value = ARR_BOOKING;
            }
        })
    })
}

$('#time_start').timepicker({
    timeFormat: 'H:i',
});
$('#time_end').timepicker({
    timeFormat: 'H:i',
});
$('#time_completion').timepicker({
    timeFormat: 'H:i',
    step: 15,
});

//Show password
$(".reveal").on('click',function() {
    var $pwd = $(".pwd");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
