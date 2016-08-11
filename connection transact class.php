<?php
class TransactionDemo{
 const DB_HOST = 'localhost';
 const DB_NAME = 'classicmodels';
 const DB_USER = 'root';
 const DB_PASSWORD = '';
 
 private $conn = null;
 
 private $message = '';
 
 /**
 * get message
 * @return string the message of transferring process
 */
 public function getMessage() {
 return $this->message;
 }
 
 /**
 * transfer money from the $from account to $to account
 * @param int $from
 * @param int $to
 * @param float $amount
 * @return true on success or false on failure. The message is logged in the
 * $message
 */
 public function transfer($from,$to,$amount) {
 
 try {
 $this->conn->beginTransaction();
 
 // get available amount of the transferred account
 $sql = 'SELECT amount FROM accounts WHERE id=:from';
 $stmt = $this->conn->prepare($sql);
 $stmt->execute(array(":from" => $from));
 $availableAmount = (int)$stmt->fetchColumn();
 $stmt->closeCursor();
 
 if($availableAmount < $amount){
 $this->message = 'Insufficient amount to transfer';
 return false;
 }
 // deduct from the transferred account
 $sql_update_from = 'UPDATE accounts
     SET amount = amount - :amount
     WHERE id = :from';
 $stmt = $this->conn->prepare($sql_update_from);
 $stmt->execute(array(":from"=> $from, ":amount" => $amount));
 $stmt->closeCursor();
 
 // add to the receiving account
 $sql_update_to  = 'UPDATE accounts
    SET amount = amount + :amount
    WHERE id = :to';
 $stmt = $this->conn->prepare($sql_update_to);
 $stmt->execute(array(":to" => $to, ":amount" => $amount));
 
 // commit the transaction
 $this->conn->commit();
 
 $this->message = 'The amount has been transferred successfully';
 
 return true;
 } catch (Exception $e) {
 $this->message = $e->getMessage();
 $this->conn->rollBack();
 }
 }
 
 /**
 * Open the database connection
 */
 public function __construct(){
 // open database connection
 $connectionString = sprintf("mysql:host=%s;dbname=%s",
 TransactionDemo::DB_HOST,
 TransactionDemo::DB_NAME);
 try {
 $this->conn = new PDO($connectionString,
 TransactionDemo::DB_USER,
 TransactionDemo::DB_PASSWORD);
 
 } catch (PDOException $pe) {
 die($pe->getMessage());
 }
 }
 
 /**
 * close the database connection
 */
 public function __destruct() {
 // close the database connection
 $this->conn = null;
 }
}


// working with procedures in php //
function call_sp($customerNumber)
{
    try {
        $conn = new PDO("mysql:host=localhost;dbname=classicmodels", 'root', '');
 
        // execute the stored procedure
        $sql = 'CALL get_order_by_cust(:no,@shipped,@canceled,@resolved,@disputed)';
        $stmt = $conn->prepare($sql);
 
        $stmt->bindParam(':no', $customerNumber, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
 
        // execute the second query to get values from OUT parameter
        $r = $conn->query("SELECT @shipped,@canceled,@resolved,@disputed")
                  ->fetch(PDO::FETCH_ASSOC);
        if ($r) {
            printf('Shipped: %d, Canceled: %d, Resolved: %d, Disputed: %d',
                $r['@shipped'],
                $r['@canceled'],
                $r['@resolved'],
                $r['@disputed']);
        }
    } catch (PDOException $pe) {
        die("Error occurred:" . $pe->getMessage());
    }
}
 
call_sp(141);

//in mysql - creating a proc //
DELIMITER $$
 
CREATE PROCEDURE get_order_by_cust(
 IN cust_no INT,
 OUT shipped INT,
 OUT canceled INT,
 OUT resolved INT,
 OUT disputed INT)
BEGIN
 -- shipped
 SELECT
            count(*) INTO shipped
        FROM
            orders
        WHERE
            customerNumber = cust_no
                AND status = 'Shipped';
 
 -- canceled
 SELECT
            count(*) INTO canceled
        FROM
            orders
        WHERE
            customerNumber = cust_no
                AND status = 'Canceled';
 
 -- resolved
 SELECT
            count(*) INTO resolved
        FROM
            orders
        WHERE
            customerNumber = cust_no
                AND status = 'Resolved';
 
 -- disputed
 SELECT
            count(*) INTO disputed
        FROM
            orders
        WHERE
            customerNumber = cust_no
                AND status = 'Disputed';
 
END
//calling a proc //
CALL get_order_by_cust(141,@shipped,@canceled,@resolved,@disputed);
 
SELECT @shipped,@canceled,@resolved,@disputed;


//creating triggers //


//using conditions in mysql //
SELECT 
    customerName, state, country
FROM
    customers
ORDER BY (CASE
    WHEN state IS NULL THEN country
    ELSE state
END);


2
3
4
5
6
7
SELECT 
    customerNumber,
    customerName,
    IF(state IS NULL, 'N/A', state) state,
    country
FROM
    customers;
	
	
//using concat //
SELECT 
    productname,
    CONCAT('$',
            FORMAT(quantityInStock * buyPrice, 2)) stock_value
FROM
    products;
	
	
//pdo persistent connection //
$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(  
PDO::ATTR_PERSISTENT => true)); 


//triggers in ms sql //
now.column = inserted 
old.column = deleted 
//trigger sample for ms sql server //
USE MSSQLTips;
GO

CREATE TABLE dbo.SampleTable (
  SampleTableID INT NOT NULL IDENTITY(1,1),
  SampleTableInt INT NOT NULL,
  SampleTableChar CHAR(5) NOT NULL,
  SampleTableVarChar VARCHAR(30) NOT NULL,
  CONSTRAINT PK_SampleTable PRIMARY KEY CLUSTERED (SampleTableID)
);
GO

CREATE TABLE dbo.SampleTable_Audit (
  SampleTableID INT NOT NULL,
  SampleTableInt INT NOT NULL,
  SampleTableChar CHAR(5) NOT NULL,
  SampleTableVarChar VARCHAR(30) NOT NULL,
  Operation CHAR(1) NOT NULL,
  TriggerTable CHAR(1) NOT NULL,
  AuditDateTime smalldatetime NOT NULL DEFAULT GETDATE(),
);

CREATE INDEX IDX_SampleTable_Audit_AuditDateTime ON dbo.SampleTable_Audit (AuditDateTime DESC);
GO

CREATE TRIGGER dbo.SampleTable_InsertTrigger
ON dbo.SampleTable
FOR INSERT
AS
BEGIN
   INSERT INTO dbo.SampleTable_Audit
   (SampleTableID, SampleTableInt, SampleTableChar, SampleTableVarChar, Operation, TriggerTable)    
   SELECT SampleTableID, SampleTableInt, SampleTableChar, SampleTableVarChar, 'I', 'I'
   FROM inserted;
END;
GO

CREATE TRIGGER dbo.SampleTable_DeleteTrigger
ON dbo.SampleTable
FOR DELETE
AS
BEGIN
   INSERT INTO dbo.SampleTable_Audit
   (SampleTableID, SampleTableInt, SampleTableChar, SampleTableVarChar, Operation, TriggerTable)    
   SELECT SampleTableID, SampleTableInt, SampleTableChar, SampleTableVarChar, 'D', 'D'
   FROM deleted;
END;
GO

CREATE TRIGGER dbo.SampleTable_UpdateTrigger
ON dbo.SampleTable
FOR UPDATE
AS
BEGIN
   INSERT INTO dbo.SampleTable_Audit
   (SampleTableID, SampleTableInt, SampleTableChar, SampleTableVarChar, Operation, TriggerTable)    
   SELECT SampleTableID, SampleTableInt, SampleTableChar, SampleTableVarChar, 'U', 'D'
   FROM deleted;--remember deleted is the old data --
  
   INSERT INTO dbo.SampleTable_Audit
   (SampleTableID, SampleTableInt, SampleTableChar, SampleTableVarChar, Operation, TriggerTable)    
   SELECT SampleTableID, SampleTableInt, SampleTableChar, SampleTableVarChar, 'U', 'I'
   FROM inserted;
END;
GO 

//asp parameter //
' Open Connection Conn
set ccmd = CreateObject("ADODB.Command")
ccmd.Activeconnection= Conn

ccmd.CommandText="SPWithParam"
ccmd.commandType = 4 'adCmdStoredProc

ccmd.parameters.Item("InParam").value = "hello world" ' input parameter
ccmd.execute()

' Access ccmd.parameters(0) as return value of stored procedure
' Access ccmd.parameters(2) or ccmd.parameters("OutParam") as the output parameter.