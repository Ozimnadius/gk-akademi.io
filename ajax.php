<?php
header('Content-Type: application/json');
require 'config.php';
require 'recaptchalib.php';

$data = $_POST;
$action = $data['action'];
switch ($action) {
    case 'callorderSubmit':
        echo json_encode(array(
            'status' => true,
            'html' => callorderSubmit($cnf, $data)
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
        <li class="modal__item">Товары для делопроизводства</li>
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

function callorderSubmit($cnf, $data)
{

    $re = new ReCaptcha($cnf['privateKey']);
    $reResult = $re->verifyResponse($_SERVER['REMOTE_ADDR'], $data['g-recaptcha-response']);




    if ($reResult->success) {
        /*mail*/
        $email = 'client@web-comp.ru';
        $title = 'Форма обратной связи с сайта gk-akademi.ru';
        ob_start(); ?>
        <table>
            <tr>
                <td><b>Форма обратной связи с сайта gk-akademi.ru</b></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Имя: </b></td>
                <td><?= $data['name'] ?></td>
            </tr>
            <tr>
                <td><b>Номер телефона: </b></td>
                <td><?= $data['tel'] ?> <br></td>
            </tr>
            <tr>
                <td><b>Email: </b></td>
                <td><?= $data['email'] ?></td>
            </tr>
            <tr>
                <td><b>Вопрос: </b></td>
                <td><?= $data['comment'] ?></td>
            </tr>
        </table>

        <?
        $content = ob_get_contents();
        ob_end_clean();

//        $headers = "MIME-Version: 1.0\n" ;
//        $headers .= "Content-Type: text/html; charset=\"windows-1251\"\n";
        $headers = "Content-type: text/html; charset=\"utf-8\"";

        $result = mail($email, $title, $content,$headers);
        /*END mail*/

        if ($result) {
            ob_start(); ?>
            <div class="form__success">Спасибо мы скоро с Вами свяжемся.
                <div class="form__success-close">
                    <svg class="form__success-svg">
                        <use xlink:href="images/icons/sprite.svg#close"></use>
                    </svg>
                </div>
            </div>
            <?
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        } else {
            ob_start(); ?>
            <div class="form__success form__success_error">Что-то пошло не так попробуйте еще раз!
                <div class="form__success-close">
                    <svg class="form__success-svg">
                        <use xlink:href="images/icons/sprite.svg#close"></use>
                    </svg>
                </div>
            </div>
            <?
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }
    } else {
        ob_start(); ?>
        <div class="form__success form__success_error">Вы робот!
            <div class="form__success-close">
                <svg class="form__success-svg">
                    <use xlink:href="images/icons/sprite.svg#close"></use>
                </svg>
            </div>
        </div>
        <?
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}