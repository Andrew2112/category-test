Задание выполнено на Open Server 5.3.8, PHP-7.4, MySQL -5.7 с использованием Yii2.
Реализована одна страница на которой отображены категории и товары, находящиеся в них, сгруппированные по этим категориямюю
Если товар «в наличии», то у такого товара есть кнопка «Добавить в корзину».
По нажатию идет AJAX запрос и:
-товар сохраняется в корзине в сессии 
-при нажатии "сохранить заказ" корзина сохраняется в базу данных (сессия, товар, дата добавления, цена, количество, общая сумма)
-отображается количество добавленных товаров и их сумма в корзине в шапке страницыю Для работы необходимо установить Composer и зависимости из файла composer.json 
База данных проекта находиться в корневом каталоге в файле category_test.sql
