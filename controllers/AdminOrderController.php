<?php

/**
 * Контроллер AdminOrderController
 * Управление заказами в админпанели
 */
class AdminOrderController extends AdminBase
{

    /**
     * Action для страницы "Управление заказами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список заказов
        $ordersList = Order::getOrdersList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

   

    /**
     * Action для страницы "Просмотр заказа"
     */
    public function actionView($id)
    {
        // Проверка доступа
        self::checkAdmin();
        $order = Order::getOrderById($id);

        $det = Order::getOrderDetails($id);

        
        $valnam = array(); $valnam = json_decode($det[0]['tickets'], true); $pup = array();$pup = Order::getTicketsData($valnam[1]['ticket_id']);
        $ara = array(); $ara = json_decode($det[0]['tickets'], true); $sum = 0;

        

        // Подключаем вид
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }

    /**
     * Action для страницы "Удалить заказ"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем заказ
            Order::deleteOrderById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/order");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }

}
