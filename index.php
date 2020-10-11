<?php 

class DBConnection
{
  private static $_instance = null;
  private static $_connectParams = array(
    '_host' => '',                               //SET YOUR HOST
    '_user' => '',                               //SET YOUR DB USERNAME
    '_db' => '',                                 //SET YOUR DB NAME
    '_password' => ''                            //SET YOUR DB PASSWORD
  );

  private function __construct(){}
  private function __clone(){}
  private function __wakeup(){}

  static public function getInstance() {
  
    if(is_null(self::$_instance))
    {
      self::$_instance = new \mysqli();
      self::$_instance->connect(self::$_connectParams['_host'], self::$_connectParams['_user'],  self::$_connectParams['_password'],
      self::$_connectParams['_db']);
    }
    return self::$_instance;
  }
}

$db = DBConnection::getInstance();

$result = $db->query("SELECT R.day, GROUP_CONCAT(R.str SEPARATOR ', ') AS 'top'
                      FROM
                          (
                          SELECT
                          DAYNAME(TR.date) AS 'day', CONCAT(E.`name`, ' (' , ROUND(AVG(TR.`hours`),2), ' hours)') AS 'str',
                      RANK() OVER(PARTITION BY DAYNAME(TR.date)
                      ORDER BY AVG(TR.`hours`) DESC) 'trank'
                      FROM
                      time_reports TR
                      LEFT JOIN employees E ON
                      E.id = TR.employee_id
                      GROUP BY DAY, E.`name`) R
                      WHERE
                      R.trank < 4
                      GROUP BY R.day
                      ORDER BY R.day");

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($data as $itemData) {
  echo (" | " . $itemData['day'] . " | " . $itemData['top'] . " |\n");
}