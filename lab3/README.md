# lab3

# Знакомство с языком JavaScript  
# Цель работы  
Познакомиться с синтаксисом и семантикой языка JavaScript, понятием Document Object Model, Browser
Object Model.  
# Задача  
Дано: HTML-страница, на которой есть кнопки «Создать таблицу», «Добавить строку», «Удалить строку  
No» и текстовое поле для ввода чисел. Далее описано поведение, связанное с нажатием на каждую из  
них. По-умолчанию все кнопки, кроме «Создать таблицу» заблокированы (используйте атрибут  
disabled). Таблица должна содержать не менее двух столбцов с произвольным содержимым, однако  
первый столбец обязательно содержит номер строки.  
  
Создать таблицу  
  
На страницу добавляется элемент table. Для простоты доступа к таблице сразу же задайте ей атрибут  
id. При повторном нажатии на кнопку в случае, если таблица уже существует, необходимо показать  
модальное окно с сообщением об ошибке (alert).  
  
Добавить строку  
  
Происходит добавление новой строки в конец таблицы.
  
Удалить строку
  
Выполняется удаление строки с указанным номером. Номер указывается в текстовом поле,  
расположенном рядом с этой кнопкой, при этом должна выполняться валидация значений по  
следующим признакам: во-первых, это должно быть число, а во-вторых, строка с соответствующим  
номером должна существовать.  
