# nova_Module_Navbar


- [Общая информация](#Что-это)
- [Зависимости](#Зависимости)
- [Установка Модуля](#Установка-Модуля)
- [Документация](#Документация)

## Что это
Nova-framework это новое название PHP фреймворка известного ранее как SMVC

## Зависимости
Необходим сам фреймворк, 3+ версии

## Установка Модуля

* ### Копируем файлы
* ### Правим используемый Template
        В Templates\Default\default.php + header.php
        Убираем сверху весь код, вплоть до <!DOCTYPE html>
        Далее, выделяем все начиная с блока <body вплоть до <?=afterBody?>
        Удаляем. Вставляем на это место:
```
<body>
<?php
if(!empty($nav = Event::until('Navbar')))
{
    echo $nav;
}
else
{
    echo $afterBody;
}
?>
```
* ### Правим Templates\Default\Assets\css\style.css, комментируем верхний 
```
body {
    /* Margin bottom by footer height */
    margin-bottom: 60px;
    /*padding-top: 60px;*/
}
```   
* Активируем модуль в конфиге
    
## Документация
> *ОТСУТСТВУЕТ!* Пока...

