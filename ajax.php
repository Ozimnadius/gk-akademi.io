<?php
header('Content-Type: application/json');

$data = $_POST;
$action = $data['action'];
switch ($action) {
    case 'callorderSubmit':
        echo json_encode(array(
            'status' => true,
            'html' => '<div class="form__success">Спасибо мы скоро с Вами свяжемся. <div class="form__success-close"><svg class="form__success-svg"><use xlink:href="images/icons/sprite.svg#close"></use> </svg></div></div>'
        ));
        exit();
        break;
    case 'modalOpen':
        echo json_encode(array(
            'status' => true,
            'html' => modalContent($_POST['id'])
        ));
        exit();
        break;
    default:
        echo json_encode(array(
            'status' => false,
        ));
        exit();
        break;
}

function modalContent($id)
{
    ob_start();
    ?>
    <div class="modal__title">
        Учебным заведениям
    </div>
    <div class="modal__img">
        <img src="images/content/modal.png" alt="Учебным заведениям" class="modal__pic">
    </div>

    <ul class="modal__list">
        <li class="modal__item">Оборудование для организации учебного процесса</li>
        <li class="modal__item">Хозяйственные, моющие и дезинфицирующие средства</li>
        <li class="modal__item">Товары для делопроизводства </li>
        <li class="modal__item">Компьютеры и комплектующие</li>
        <li class="modal__item">Системы архивации и хранения</li>
        <li class="modal__item">Презентационное и демонстрационное оборудование</li>
        <li class="modal__item">Бумага и писчебумажная продукция</li>
        <li class="modal__item">Оргтехника и расходные материалы</li>
        <li class="modal__item">Спецодежда</li>
        <li class="modal__item">Вывески, таблички, информационные доски</li>
        <li class="modal__item">Средства индивидуальной защиты</li>
    </ul>

    <a href="#" class="modal__link jsCallorderOpen">
        Уточнить подробности
    </a>
    <?
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}