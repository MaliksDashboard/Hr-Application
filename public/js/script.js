
document.addEventListener('DOMContentLoaded', () => {
    const sep = document.getElementById('seperator');
    const nav = document.getElementById('nav');
    const help = document.getElementById('help');
    const icon = document.getElementById('icon');

    icon.addEventListener('click', () => {
        nav.classList.toggle('collapsed');

        if (nav.classList.contains('collapsed')) {
            sep.innerHTML = '<p class="seperator"></p>';
            help.innerHTML = `
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2m0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16m0 12a1 1 0 1 1 0 2 1 1 0 0 1 0-2m0-10a4 4 0 0 1 1.19 7.82l-.19.054V14a1 1 0 0 1-1.993.117L11 14v-1a1 1 0 0 1 .883-.993l.266-.012A2 2 0 1 0 10 10a1 1 0 0 1-2 0 4 4 0 0 1 4-4"/>
                </svg>`;
            icon.innerHTML = `
 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 800" xml:space="preserve"><path d="M625.1 100.9H175.3c-41.4 0-74.9 33.5-74.9 74.9V626c0 41.4 33.6 74.9 74.9 74.9h449.9c41.4 0 74.9-33.6 74.9-74.9V175.8c-.1-41.3-33.6-74.9-75-74.9M150.3 613.6V188.3c0-20.6 16.7-37.4 37.4-37.4h23v500h-23c-20.7 0-37.4-16.7-37.4-37.3" style="fill-rule:evenodd;clip-rule:evenodd"/></svg>`;
        } else {
            sep.innerHTML = `<p class="seperator">Organization</p>`;
            help.innerHTML = `<p>Need Help?</p> <small>Call Shadi Farhat</small>`;
            icon.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 800" xml:space="preserve">
                    <path
                        d="M625.1 700.9H175.3c-41.4 0-74.9-33.6-74.9-74.9V175.8c0-41.4 33.6-74.9 74.9-74.9h449.9c41.4 0 74.9 33.5 74.9 74.9V626c-.1 41.4-33.6 74.9-75 74.9m-324.8-50v-500H187.7c-20.6 0-37.4 16.7-37.4 37.4v425.3c0 20.6 16.7 37.4 37.4 37.4h112.6z"
                        style="fill-rule:evenodd;clip-rule:evenodd" />
                </svg>`;
        }
    });


//Count the checked boxes    
const count=document.getElementById('count-select')
const boxes = document.querySelectorAll('input[type="checkbox"]');

function updateCount(){
    let total=0;
    boxes.forEach(function(box){
        if(box.checked){
            total++
        }
    });
    if(total===0){
        count.innerHTML=``;
    }else {
    count.innerHTML=`<div style="display:flex; gap:5px; justify-content:center; align-items:center;"><p style="color:var(--primary-color); font-weight:bold; font-size:24px;">`+total+` </p> <p style="color: var(--second-color);"> Selected</p> </div>`}
}

boxes.forEach((box)=>{
    box.addEventListener('change',updateCount);
})

updateCount();

//Counting the New Joiners
const newHire=document.getElementById('new-hire');
const joinDate=document.querySelectorAll('.join-date');
const sixMonthsAgo = new Date(); 
sixMonthsAgo.setMonth(sixMonthsAgo.getMonth() - 6);

let countDate=0;

joinDate.forEach((date)=>{
    const hireDate=new Date(date.textContent.trim());
    if(hireDate>=sixMonthsAgo){
        countDate++
    }
});
const plural = countDate === 1 ? '' : 's';

newHire.innerHTML = `<small class="hire-alert">+ ${countDate} New Hire${plural}</small>`;

//Search Functionlaity
const searchBox=document.getElementById('search-box');
const cards=document.querySelectorAll('.card');

searchBox.addEventListener('input',(e)=>{
    const searchValue=e.target.value.toLowerCase().trim();
    const searchWords=searchValue.split(/\s+/);

    if(searchValue===''){
        cards.forEach((card)=>{
            card.style.display='flex';
        })
        return;
    }

    cards.forEach((card) => {
        const nameElement = card.querySelector('.card-info b');
        const departmentElement = card.querySelector('.details-second p');
        const statusElement = card.querySelector('.card-header-right p');
        const phoneElement = card.querySelector('.number');
    
        const name = nameElement ? nameElement.textContent.toLowerCase() : '';
        const department = departmentElement ? departmentElement.textContent.toLowerCase() : '';
        const status = statusElement ? statusElement.textContent.toLowerCase() : '';
        const phone = phoneElement ? phoneElement.textContent.toLowerCase().trim() : '';
    
        const isMatch = searchWords.every((word) =>
            name.includes(word) || department.includes(word) || status.includes(word) || phone.includes(word)
        );
    
        if (isMatch) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
})

//Open the More Actions box

const moreActions=document.getElementById('moreActions');
const boxActions=document.querySelector('.more-actions');

moreActions.addEventListener('click', () => {
    if (boxActions.classList.contains('box-visible')) {
        boxActions.classList.remove('box-visible');
        boxActions.classList.add('box-hidden');
    } else {
        boxActions.classList.remove('box-hidden');
        boxActions.classList.add('box-visible');
    }
});

//Open The Filter Box

const filterBtn=document.querySelector('.filter');
const filterBox=document.querySelector('.filter-box');

filterBtn.addEventListener('click',()=>{
    if(filterBox.classList.contains('show-box')){
        filterBox.classList.add('hide-box');
        filterBox.classList.remove('show-box');
    }else {
        filterBox.classList.add('show-box');
        filterBox.classList.remove('hide-box');
    }
})

const filterSearch = document.getElementById('filter-search');
const namebranch = document.querySelectorAll('.filter-branch');

filterSearch.addEventListener('input', (e) => {
    const searchValue = e.target.value.toLowerCase().trim();
    const searchWords = searchValue.split(/\s+/);

    namebranch.forEach((branch) => {
        const branchText = branch.textContent.toLowerCase().trim(); 

        const isMatch = searchWords.every((word) =>
            branchText.includes(word)
        );

        if (isMatch) {
            branch.style.display = 'block';
        } else {
            branch.style.display = 'none';
        }
    });
});

//Count Employees

const countEmp=document.getElementById('emp-count');
let empCount=0

cards.forEach((card)=>{
    const empStatus=card.querySelector('.active-style');
    if(empStatus && empStatus.textContent.trim()==='Active'){
    empCount++}
})

countEmp.innerHTML=`${empCount} Active Employees`

});

