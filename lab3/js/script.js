// переменная для хранения таблицы
let table;

// функция для создания таблицы
function createTable() {
  // проверяем, существует ли уже таблица
  if (table) {
    alert('Таблица уже существует');
    return;
  }

  // создаем таблицу и добавляем ей атрибут id
  table = document.createElement('table');
  table.id = 'my-table';

  // создаем заголовок таблицы
  const thead = document.createElement('thead');
  const tr = document.createElement('tr');
  const th1 = document.createElement('th');
  const th2 = document.createElement('th');
  th1.textContent = '№';
  th2.textContent = 'Заголовок';
  tr.appendChild(th1);
  tr.appendChild(th2);
  thead.appendChild(tr);
  table.appendChild(thead);

  // создаем тело таблицы
  const tbody = document.createElement('tbody');
  table.appendChild(tbody);

  // добавляем таблицу на страницу
  const tableContainer = document.getElementById('table-container');
  tableContainer.appendChild(table);

  // разблокируем кнопки "Добавить строку" и "Удалить строку"
  document.getElementById('add-row').disabled = false;
  document.getElementById('delete-row').disabled = false;
  document.getElementById('row-number').disabled = false;
}

// функция для добавления строки
function addRow() {
  const tbody = table.getElementsByTagName('tbody')[0];
  const rowCount = tbody.getElementsByTagName('tr').length;

  // создаем новую строку
  const tr = document.createElement('tr');

  // создаем ячейки в строке
  const td1 = document.createElement('td');
  const td2 = document.createElement('td');
  td1.textContent = rowCount + 1;
  td2.textContent = 'Ячейка';

  // добавляем ячейки в строку
  tr.appendChild(td1);
  tr.appendChild(td2);

  // добавляем строку в таблицу
  tbody.appendChild(tr);
}

// функция для удаления строки
function deleteRow() {
  const rowNumberInput = document.getElementById('row-number');
  const rowNumber = Number(rowNumberInput.value);

  // проверяем, является ли значение в поле номером
  if (isNaN(rowNumber)) {
    alert('Введите номер строки');
    return;
  }

  const tbody = table.getElementsByTagName('tbody')[0];
  const rowCount = tbody.getElementsByTagName('tr').length;

  // проверяем, существует ли строка с указанным номером
  if (rowNumber < 1 || rowNumber > rowCount) {
    alert('Строки с таким номером не существует');
    return;
  }

  // получаем строку по номеру и удаляем ее
  const tr = tbody.getElementsByTagName('tr')[rowNumber - 1];
  tbody.removeChild(tr);

  // перенумеровываем оставшиеся строки
  const rows = tbody.getElementsByTagName('tr');
  for (let i = 0; i < rows.length; i++) {
  const td1 = rows[i].getElementsByTagName('td')[0];
  td1.textContent = i + 1;
  }

  // очищаем поле ввода
  rowNumberInput.value = '';
}
