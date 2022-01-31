let table = document.getElementById('tableCars') // обращение к таблице
const tbody = document.createElement('tbody') // обращение к содержимому таблицы
// обращение к инпутам заполнения
let brand = document.getElementById('brand');
let model = document.getElementById('model');
let color = document.getElementById('color');
let number = document.getElementById('number');
let price = document.getElementById('price');
let search = document.getElementById('search-text');

// статические данные для заполнения таблицы
const base_cars = [
    newCars("AUDI", "Q7", "Красный", "11", "2600265"),
    newCars("BMW", "X3", "Желтый", "4", "4520000"),
    newCars("TOYOTA", "Camry", "Белый", "2", "2710000"),
    newCars("CHEVROLET", "Trailblazer", "Желтый", "3", "2024000"),
    newCars("PORSCHE", "Panamera", "Черный", "5", "8210000"),
    newCars("SKODA", "Octavia", "Серый", "3", "1598000"),
    newCars("TOYOTA", "Land Cruiser Prado", "Черный", "8", "3237000"),
    newCars("AUDI", "Q5", "Белый", "2", "2710000"),
    newCars("AUDI", "A3 Sedan", "Красный", "52", "2675000"),
    newCars("BMW", "M4", "Зеленый", "7", "7670000"),
];

//для получение данных по значению ключа

function newCars(brand, model, color, number, price){
    return {brand, model, color, number, price}
}

// очистка инпутов после добавления в таблицу

function clear(){
    brand.value = '';
    model.value = ''; 
    color.value = ''; 
    number.value = ''; 
    price.value = '';
}

/* вывод статических данных в таблицу. */

function addToTable(car){
const tr = document.createElement('tr');

    for (var key of Object.keys(car)) {
        const td = document.createElement('td');
        td.textContent = car[key];
        tr.appendChild(td);
    }
    
// Кнопка удаления. ( создаем td, создаем кнопку, при нажатии на кнопку удаляет строку.)

const delButTd = document.createElement('td')
const delButton = document.createElement('button')
delButton.textContent = "Удалить"

delButton.onclick = function(){ 
    if (confirm("Удалить?")) {

    const del = this.parentElement.parentElement
    del.remove()
}};
delButTd.appendChild(delButton) 
tr.appendChild(delButTd)
tbody.appendChild(tr);
table.appendChild(tbody);



// редактирование элементов  

let editTd = document.querySelectorAll('td')


for ( let i = 0; i < editTd.length; i++){

    editTd[i].onclick = function() {

    if (this.hasAttribute('data-clicked')){
        return;
    }

    this.setAttribute('data-clicked', 'yes');
    this.setAttribute('data-text', this.innerHTML)

    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.value = this.innerHTML;
    input.onblur = function() {

    let td = input.parentElement;
    let text = input.parentElement.getAttribute('data-text');
    let currentText = this.value;

            if (text != currentText){
                td.removeAttribute("data-clicked");
                td.removeAttribute("data-text");
                td.innerHTML = currentText;
            } else {
                td.removeAttribute("data-clicked");
                td.removeAttribute("data-text");
                td.innerHTML = text;
                }
            }

            this.innerHTML = "";
            this.append(input);
            this.firstElementChild.select()
        }  
    }

}
// пагинация

let pagination = document.querySelector('#pagination')
let notesOnPage = 4; // количество записей на странице
let countOfItems = Math.ceil(base_cars.length / notesOnPage)
let defaultBase = base_cars.slice(0, 3); // определение какие элементы на какой странице будут выводится
let items = []

for ( let i = 1; i <= countOfItems; i++){
    let li = document.createElement("li")
    li.innerHTML = i
    pagination.appendChild(li)
    items.push(li)
}

let active;
showPage(items[0]);

for (let item of items) {
    item.addEventListener('click', function() {
        showPage(item)
    })
}

function showPage(item) {

    if (active) {
        active.classList.remove('active')
    }

active = item;
item.classList.add('active')
let pageNum = +item.innerHTML; // номер страницы
let start = (pageNum - 1) * notesOnPage 
let end = start + notesOnPage; 
let notes = base_cars.slice(start, end); // определение какие элементы на какой странице будут выводится
tbody.innerHTML = ""

notes.forEach(function (car) {
        addToTable(car);
    })
}
    

// добавление элементов

const addCar = document.getElementById('add_car');
addCar.onclick = function() { 
if (brand.value === null || brand.value === "" || price.value === null || price.value === "" || model.value === null || model.value === "" || color.value === null || color.value === "" || number.value === null || number.value === "")  {
  alert("При добавлении все поля должны быть заполнены!");
}
 else {
    const car = newCars(brand.value, model.value, color.value, number.value, price.value)

    addToTable(car);
    clear()
 }
}

// поиск по таблице

function tableSearch() {

    var phrase = document.getElementById('search-text');
    var regPhrase = new RegExp(phrase.value, 'i');
    var flag = false;
    for (var i = 1; i < table.rows.length; i++) {
        flag = false;
        for (var j = table.rows[i].cells.length - 1; j >= 0; j--) {
            flag = regPhrase.test(table.rows[i].cells[j].innerHTML);
            if (flag) break;
        }
        if (flag) {
            table.rows[i].style.display = "";
        } else {
            table.rows[i].style.display = "none";
        }
    }
}

// Сортировка таблицы
let colIndex = -1;


const sortTable = function (index, type, isSorted) {
const tbody = table.querySelector("tbody")

const compare = function (rowA, rowB) {
const rowDataA = rowA.cells[index].innerHTML;
const rowDataB = rowB.cells[index].innerHTML;

switch (type) {
    case  'integer':
    case  "double":

        return rowDataA - rowDataB;
    break;

    case  'text':

        if (rowDataA < rowDataB) return -1;
        else if (rowDataA > rowDataB) return 1;
        return 0;
    break;
    }
}

let rows = [].slice.call(tbody.rows);

rows.sort(compare);

if (isSorted) rows.reverse();

table.removeChild(tbody);

for (let i = 0; i < rows.length; i++) {
    tbody.appendChild(rows[i]);
}

table.appendChild(tbody);

}

table.addEventListener('click', (e) => {
const el = e.target;
if (el.nodeName != 'TH') return;

const index = el.cellIndex;
const type = el.getAttribute('data-type');

sortTable(index, type, colIndex === index);
colIndex = (colIndex === index) ? -1 : index;
})

// Защита от ввода нежелательных символов

let protection = /[!@#$%^&*()_+`~=.?,<>|/\-]/g;
let protection1 = /[+-]/g;

brand.oninput = function(){
    this.value = this.value.replace(protection, '');
}
model.oninput = function(){
    this.value = this.value.replace(protection, '');
}
color.oninput = function(){
    this.value = this.value.replace(protection, '');
}
search.oninput = function(){
    this.value = this.value.replace(protection, '');
}
number.oninput = function(){
    this.value = this.value.replace(protection1, '');
}
price.oninput = function(){
    this.value = this.value.replace(protection1, '');
}

