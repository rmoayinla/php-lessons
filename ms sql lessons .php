//@@rowcount returns the no of rows affected during the last action //
UPDATE authors SET au_lname = 'Jones'
WHERE au_id = '999-888-7777'
IF @@ROWCOUNT = 0
   print 'Warning: No rows were updated'
   
   
 //using case statement //
 USE pubs
GO
SELECT    'Price Category' = 
      CASE 
         WHEN price IS NULL THEN 'Not yet priced'
         WHEN price < 10 THEN 'Very Reasonable Title'
         WHEN price >= 10 and price < 20 THEN 'Coffee Table Title'
         ELSE 'Expensive book!'
      END,
   CAST(title AS varchar(20)) AS 'Shortened Title'
FROM titles
ORDER BY price
GO


SELECT SUBSTRING((RTRIM(a.au_fname) + ' '+ 
   RTRIM(a.au_lname) + ' '), 1, 25) AS Name, a.au_id, ta.title_id,
   Type = 
  CASE 
    WHEN SUBSTRING(ta.title_id, 1, 2) = 'BU' THEN 'Business' // when first and last string //
    WHEN SUBSTRING(ta.title_id, 1, 2) = 'MC' THEN 'Modern Cooking'
    WHEN SUBSTRING(ta.title_id, 1, 2) = 'PC' THEN 'Popular Computing'
    WHEN SUBSTRING(ta.title_id, 1, 2) = 'PS' THEN 'Psychology'
    WHEN SUBSTRING(ta.title_id, 1, 2) = 'TC' THEN 'Traditional Cooking'
  END
  
  
  //add check //
  ALTER TABLE dbo.Vendors ADD CONSTRAINT CK_Vendor_CreditRating withnocheck
    CHECK (CreditRating >= 1 AND CreditRating <= 5) //WITH NOCHECK -- this makes sure this constraint only apply to the new data not existing ones //
	
	ALTER TABLE dbo.Payroll 
	    WITH NOCHECK ADD CONSTRAINT CK_Payroll_SalaryType
	    CHECK (SalaryType in ('Hourly','Monthly','Annual'));
		
		
		ALTER TABLE dbo.Payroll  
	    WITH NOCHECK ADD CONSTRAINT CK_Payroll_SalaryType 
	    CHECK (SalaryType in ('Hourly','Monthly','Annual')),
	      CONSTRAINT CK_Payroll_Salary
	    CHECK (Salary > 10.00 and Salary < 150000.00); 
		
		ALTER TABLE dbo.Payroll WITH NOCHECK  
	  ADD  CONSTRAINT CK_Payroll_Salary_N_SalaryType 
	  CHECK  (SalaryType in ('Hourly','Monthly','Annual')
	      and Salary > 10.00 and Salary < 150000.00);

		  ALTER TABLE dbo.Payroll WITH NOCHECK  
	  ADD  CONSTRAINT CK_Payroll_SalaryType_Based_On_Salary
	  CHECK  ((SalaryType = 'Hourly' and Salary < 100.00) or
	          (SalaryType = 'Monthly' and Salary < 10000.00) or
	          (SalaryType = 'Annual'));
			  
			  ALTER TABLE dbo.Payroll 
	    WITH NOCHECK ADD CONSTRAINT CK_Payroll_SalaryType
	    CHECK ((SalaryType in ('Hourly','Monthly','Annual'))
	            and SalaryType is not NULL);
				
		ALTER TABLE dbo.doc_exc ADD column_b VARCHAR(20) NULL 
    CONSTRAINT exb_unique UNIQUE ;
	
	ALTER TABLE dbo.doc_exz
ADD CONSTRAINT col_b_def
DEFAULT 50 FOR column_b ;


ALTER TABLE dbo.doc_exe ADD 

-- Add a PRIMARY KEY identity column.
column_b INT IDENTITY
CONSTRAINT column_b_pk PRIMARY KEY, 

-- Add a column that references another column in the same table.
column_c INT NULL  
CONSTRAINT column_c_fk 
REFERENCES doc_exe(column_a),

-- Add a column with a constraint to enforce that 
-- nonnull data is in a valid telephone number format.
column_d VARCHAR(16) NULL 
CONSTRAINT column_d_chk
CHECK 
(column_d LIKE '[0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]' OR
column_d LIKE
'([0-9][0-9][0-9]) [0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]'),

-- Add a nonnull column with a default.
column_e DECIMAL(3,3)
CONSTRAINT column_e_default
DEFAULT .081 ;

ALTER TABLE dbo.doc_exf 
ADD AddDate smalldatetime NULL
CONSTRAINT AddDateDflt
DEFAULT GETDATE() WITH VALUES ; // the existing rows will have the new default value //

ALTER TABLE dbo.doc_exc DROP CONSTRAINT my_constraint ;


CREATE TABLE dbo.trig_example 
(id INT, 
name VARCHAR(12),
salary MONEY) ;
GO
-- Create the trigger.
CREATE TRIGGER dbo.trig1 ON dbo.trig_example FOR INSERT
AS
IF (SELECT COUNT(*) FROM INSERTED
WHERE salary > 100000) > 0
BEGIN
    print 'TRIG1 Error: you attempted to insert a salary > $100,000'
    ROLLBACK TRANSACTION
END ;
GO
-- Try an insert that violates the trigger.
INSERT INTO dbo.trig_example VALUES (1,'Pat Smith',100001) ;
GO
-- Disable the trigger.
ALTER TABLE dbo.trig_example DISABLE TRIGGER trig1 ;
GO
-- Try an insert that would typically violate the trigger.
INSERT INTO dbo.trig_example VALUES (2,'Chuck Jones',100001) ;
GO
-- Re-enable the trigger.
ALTER TABLE dbo.trig_example ENABLE TRIGGER trig1 ;
GO
-- Try an insert that violates the trigger.
INSERT INTO dbo.trig_example VALUES (3,'Mary Booth',100001) ;
GO

ALTER TABLE Person.ContactBackup
ADD CONSTRAINT FK_ContactBacup_Contact FOREIGN KEY (ContactID)
    REFERENCES Person.Person (BusinessEntityID) ;
ALTER TABLE Person.ContactBackup
DROP CONSTRAINT FK_ContactBacup_Contact ;
GO
DROP TABLE Person.ContactBackup ;


SELECT contact_id,
CASE
  WHEN website_id = 1 THEN 'TechOnTheNet.com'
  WHEN website_id = 2 THEN 'CheckYourMath.com'
  ELSE 'BigActivities.com'
END
FROM contacts;

USE AdventureWorks2012;
GO
SELECT   ProductNumber, Name, "Price Range" = //this is not a column its an alias - listprice is the column 
      CASE 
         WHEN ListPrice =  0 THEN 'Mfg item - not for resale'
         WHEN ListPrice < 50 THEN 'Under $50'
         WHEN ListPrice >= 50 and ListPrice < 250 THEN 'Under $250'
         WHEN ListPrice >= 250 and ListPrice < 1000 THEN 'Under $1000'
         ELSE 'Over $1000'
      END
FROM Production.Product
ORDER BY ProductNumber ;
GO


USE AdventureWorks2012;
GO
UPDATE HumanResources.Employee
SET VacationHours = 
    ( CASE
         WHEN ((VacationHours - 10.00) < 0) THEN VacationHours + 40
         ELSE (VacationHours + 20.00)
       END
    )
OUTPUT Deleted.BusinessEntityID, Deleted.VacationHours AS BeforeValue, 
       Inserted.VacationHours AS AfterValue
WHERE SalariedFlag = 0; 


SELECT ISDATE('2014-05-01 10:03:32.001');
Result: 1


//DECLARING A VARIABLE //
DECLARE @find varchar(30)
SET @find = 'Ring%'
SELECT au_lname, au_fname, phone
FROM authors
WHERE au_lname LIKE @find


USE pubs
SET NOCOUNT ON
GO
DECLARE @pub_id char(4), @hire_date datetime
SET @pub_id = '0877'
SET @hire_date = '1/01/93'
-- Here is the SELECT statement syntax to assign values to two local 
-- variables.
-- SELECT @pub_id = '0877', @hire_date = '1/01/93'
SET NOCOUNT OFF
SELECT fname, lname
FROM employee
WHERE pub_id = @pub_id and hire_date >= @hire_date


DECLARE @site_value INT;
SET @site_value = 15;

IF @site_value < 25
   PRINT 'TechOnTheNet.com';
ELSE
   PRINT 'CheckYourMath.com';

GO

 CONSTRAINT fk_name
    FOREIGN KEY (child_col1, child_col2, ... child_col_n)
    REFERENCES parent_table (parent_col1, parent_col2, ... parent_col_n)
    ON DELETE SET NULL
    [ ON UPDATE { NO ACTION | CASCADE | SET NULL | SET DEFAULT } ] 
);


//creating secured passwords //

//create table first //
CREATE TABLE dbo.[User]
(
    UserID INT IDENTITY(1,1) NOT NULL,
    LoginName NVARCHAR(40) NOT NULL,
    PasswordHash BINARY(64) NOT NULL,
    FirstName NVARCHAR(40) NULL,
    LastName NVARCHAR(40) NULL,
    CONSTRAINT [PK_User_UserID] PRIMARY KEY CLUSTERED (UserID ASC)
)
//

CREATE PROCEDURE dbo.uspAddUser
    @pLogin NVARCHAR(50), 
    @pPassword NVARCHAR(50), 
    @pFirstName NVARCHAR(40) = NULL, 
    @pLastName NVARCHAR(40) = NULL,
    @responseMessage NVARCHAR(250) OUTPUT
AS
BEGIN
    SET NOCOUNT ON

    BEGIN TRY

        INSERT INTO dbo.[User] (LoginName, PasswordHash, FirstName, LastName)
        VALUES(@pLogin, HASHBYTES('SHA2_512', @pPassword), @pFirstName, @pLastName)

        SET @responseMessage='Success'

    END TRY
    BEGIN CATCH
        SET @responseMessage=ERROR_MESSAGE() 
    END CATCH

END

//adding password with a salt key //
ALTER TABLE dbo.[User] ADD Salt UNIQUEIDENTIFIER //add a salt column 
GO

//change the procedure name //
ALTER PROCEDURE dbo.uspAddUser
    @pLogin NVARCHAR(50), 
    @pPassword NVARCHAR(50),
    @pFirstName NVARCHAR(40) = NULL, 
    @pLastName NVARCHAR(40) = NULL,
    @responseMessage NVARCHAR(250) OUTPUT
AS
BEGIN
    SET NOCOUNT ON

    DECLARE @salt UNIQUEIDENTIFIER=NEWID() // declare a variable to store the salt //
    BEGIN TRY

        INSERT INTO dbo.[User] (LoginName, PasswordHash, Salt, FirstName, LastName)
        VALUES(@pLogin, HASHBYTES('SHA2_512', @pPassword+CAST(@salt AS NVARCHAR(36))), @salt, @pFirstName, @pLastName)

       SET @responseMessage='Success'

    END TRY
    BEGIN CATCH
        SET @responseMessage=ERROR_MESSAGE() 
    END CATCH

END

//retreiving a password stored with a salt //
CREATE PROCEDURE dbo.uspLogin
    @pLoginName NVARCHAR(254),
    @pPassword NVARCHAR(50),
    @responseMessage NVARCHAR(250)='' OUTPUT
AS
BEGIN

    SET NOCOUNT ON

    DECLARE @userID INT

    IF EXISTS (SELECT TOP 1 UserID FROM [dbo].[User] WHERE LoginName=@pLoginName)
    BEGIN
        SET @userID=(SELECT UserID FROM [dbo].[User] WHERE LoginName=@pLoginName AND PasswordHash=HASHBYTES('SHA2_512', @pPassword+CAST(Salt AS NVARCHAR(36))))

       IF(@userID IS NULL)
           SET @responseMessage='Incorrect password'
       ELSE 
           SET @responseMessage='User successfully logged in'
    END
    ELSE
       SET @responseMessage='Invalid login'

END

//sample the log in //
DECLARE	@responseMessage nvarchar(250)

--Correct login and password
EXEC	dbo.uspLogin
		@pLoginName = N'Admin',
		@pPassword = N'123',
		@responseMessage = @responseMessage OUTPUT

SELECT	@responseMessage as N'@responseMessage'

--Incorrect login
EXEC	dbo.uspLogin
		@pLoginName = N'Admin1', 
		@pPassword = N'123',
		@responseMessage = @responseMessage OUTPUT

SELECT	@responseMessage as N'@responseMessage'

--Incorrect password
EXEC	dbo.uspLogin
		@pLoginName = N'Admin', 
		@pPassword = N'1234',
		@responseMessage = @responseMessage OUTPUT

SELECT	@responseMessage as N'@responseMessage'

//using substr //
SUBSTRING(au_fname, 1, 1) // start from the first and lenght is 1 //

//concatenating string using + //
SELECT (au_lname + ',' + SPACE(1) + SUBSTRING(au_fname, 1, 1) + '.') AS Name
result 
Name                                         
-------------------------------------------- 
Bennet, A.  


//using output parameters in ado //
USE pubs
GO
//create the procedure //
CREATE PROCEDURE myProc
@outparm      int      OUTPUT
@inparm      int
AS
SELECT * FROM titles WHERE royalty > @inparm
SELECT @outparm = COUNT (*) FROM TITLES WHERE royalty > @inparm
IF (@outparm > 0)
RETURN 0
ELSE
RETURN 99
GO

An ADO code program that executes the stored procedure myProc is shown here.
Dim cn As New ADODB.Connection
Dim cmd As New ADODB.Command
Dim rs As New ADODB.Recordset
Dim fldloop As ADODB.Field
Dim param1 As Parameter, param2 As Parameter, param3 As Parameter
Dim provStr As String
Dim royalty As Variant
    
Private Sub spStart()

' Connect using the SQLOLEDB provider.
cn.Provider = "sqloledb"

' Specify connection string on Open method.
provStr = "Server=MyServer;Database=pubs;Trusted_Connection=yes"
cn.Open provStr

' Set up a command object for the stored procedure.
Set cmd.ActiveConnection = cn
cmd.CommandText = "myProc"
cmd.CommandType = adCmdStoredProc

' Set up a return parameter.
Set param1 = cmd.CreateParameter("Return", adInteger, adParamReturnValue)
cmd.Parameters.Append param1
            
' Set up an output parameter.
Set param2 = cmd.CreateParameter("Output", adInteger, adParamOutput)
cmd.Parameters.Append param2
  
' Set up an input parameter.
Set param3 = cmd.CreateParameter("Input", adInteger, adParamInput)
cmd.Parameters.Append param3
royalty = Trim(InputBox("Enter royalty:"))
param3.Value = royalty

' Execute command, and loop through recordset, printing out rows.
Set rs = cmd.Execute

Dim i As Integer
While Not rs.EOF
    For Each fldloop In rs.Fields
        Debug.Print rs.Fields(i)
        i = i + 1
    Next fldloop
    Debug.Print ""
    i = 0
    rs.MoveNext
Wend

' Need to close recordset before getting return 
' and output parameters.
rs.Close

Debug.Print "Program ended with return code: " & Cmd(0)
Debug.Print "Total rows satisfying condition: " & Cmd(1)
cn.Close

End Sub\




//working with stored procedures 2 //
CREATE PROCEDURE ProductInfo1
@ProductID int 
AS
SELECT p.ProductName, 
       c.CategoryName, s.CompanyName, 
       p.UnitPrice 
FROM Products p INNER JOIN Suppliers s ON 
        p.SupplierID = s.SupplierID
     INNER JOIN Categories c ON 
        p.CategoryID = c.CategoryID
WHERE p.ProductID=@ProductID 

CREATE PROCEDURE ProductInfo2
@ProductID int,
@ProductName nvarchar(40) OUTPUT,
@CompanyName nvarchar(40) OUTPUT,
@CategoryName nvarchar(15) OUTPUT,
@UnitPrice money OUTPUT
AS
SELECT @ProductName=p.ProductName, 
       @CategoryName=c.CategoryName, 
       @CompanyName=s.CompanyName, 
       @UnitPrice=p.UnitPrice 
FROM Products p INNER JOIN Suppliers s ON 
        p.SupplierID = s.SupplierID
     INNER JOIN Categories c ON 
        p.CategoryID = c.CategoryID
WHERE p.ProductID=@ProductID
The client scripts
To test the speed, I created two Active Server Pages (ASPs). These ASPs used ADO to call the stored procedures. They made repetitive calls to the stored procedures by checking the time, and then looping for 15 seconds, calling the stored procedure as many times as possible, and keeping count. At the end, the number of iterations through the loop is printed out, as well as the four fields. The record is only printed once, after the loop has been exited, so as not to affect the timing of the loop. Note: If you decide to try these, search for the file "adovbs.inc" and make sure it's in the same virtual directory as your ASP files. Also, make sure you change the data source in the ADO connection string to your server name.
Not surprisingly, the first ASP is named ProductInfo1.asp. It calls the stored procedure ProductInfo1 that returns the record via a recordset. The code is as follows:
<%@ Language=VBScript %>
<% option explicit %>
<HTML>
<HEAD>
</HEAD>
<BODY>
<!-- #include file="adovbs.inc" -->
<%
dim cn
dim cmd
dim rs
dim pProductID

set cn=server.CreateObject("ADODB.connection")
set cmd=server.CreateObject("ADODB.command")
set pProductID= _
   cmd.CreateParameter("ProductID",adInteger,adParamInput)
cn.Open "Provider=SQLOLEDB.1;Password=;User ID=sa;" & _
   "Initial Catalog=Northwind;Data Source=laptop"
set cmd.ActiveConnection=cn
cmd.CommandText="ProductInfo1"
cmd.Parameters.Append pProductID
pProductID.Value=1
dim StartTime
starttime=Time
dim lCount
lCount=0
do while DateDiff("s",StartTime,time)<15
   lCount=lCount+1
   set rs=cmd.Execute (,,adCmdStoredProc)
loop
response.write lCount
%>

<TABLE Border="1" Cellspacing="2" Cellpadding="2">
   <TR>
      <TH>Product Name</TH>
      <TH>Category Name</TH>
      <TH>Company Name</TH>
      <TH>Total</TH>
   </TR>
      <%
      do until rs.EOF
         Response.Write("<TR>")
         Response.Write("<TD>" & rs("ProductName") & "</TD>")
         Response.Write("<TD>" & rs("CategoryName") & "</TD>")
         Response.Write("<TD>" & rs("CompanyName") & "</TD>")
         Response.Write("<TD>" & rs("UnitPrice") & "</TD>")
         Response.Write("</TR>")
         rs.MoveNext
      loop
      %>
</TABLE>
</BODY>
</HTML>
The second ASP, ProductInfo2.asp, calls ProductInfo2, which uses output parameters to return the data. As you can see from the code, there's more effort required to deal with the output parameters. However, as you'll see in a moment, the speed increase is significant.
<%@ Language=VBScript %>
<% option explicit %>
<HTML>
<HEAD>
</HEAD>
<BODY>
<!-- #include file="adovbs.inc" -->
<%
dim cn
dim cmd
dim rs
dim pProductID
dim pProductName, pCompanyName, pCategoryName
dim pUnitPrice

set cn=server.CreateObject("ADODB.connection")
set cmd=server.CreateObject("ADODB.command")
set pProductID= _
   cmd.CreateParameter("ProductID",adInteger, _
   adParamInput)
set pProductName= _
   cmd.CreateParameter("ProductName",adVarChar, _
   adParamOutput,40)
set pCompanyName= _
   cmd.CreateParameter("CompanyName",adVarChar, _
   adParamOutput,40)
set pCategoryName= _
   cmd.CreateParameter("CategoryName",adVarChar, _
   adParamOutput,15)
set pUnitPrice= _
   cmd.CreateParameter("UnitPrice",adCurrency, _
   adParamOutput)
cn.Open "Provider=SQLOLEDB.1;Password=;User ID=sa;" & _
   "Initial Catalog=Northwind;Data Source=laptop"
set cmd.ActiveConnection=cn
cmd.CommandText="ProductInfo2"
cmd.Parameters.Append pProductID
cmd.Parameters.Append pProductName
cmd.Parameters.Append pCompanyName
cmd.Parameters.Append pCategoryName
cmd.Parameters.Append pUnitPrice
pProductID.Value=1
dim StartTime
starttime=Time
dim lCount
lCount=0
do while DateDiff("s",StartTime,time)<15
      lCount=lCount+1
      cmd.Execute ,,adCmdStoredProc + adExecuteNoRecords
loop
response.write lCount
%>

<TABLE Border="1" Cellspacing="2" Cellpadding="2">
   <TR>
      <TH>Product Name</TH>
      <TH>Category Name</TH>
      <TH>Company Name</TH>
      <TH>Total</TH>
   </TR>
   <%
   Response.Write("<TR>")
   Response.Write("<TD>" & _
     cmd.Parameters("ProductName").Value  & "</TD>")
   Response.Write("<TD>" & _
     cmd.Parameters("CategoryName").Value & "</TD>")
   Response.Write("<TD>" & _
     cmd.Parameters("CompanyName").Value & "</TD>")
   Response.Write("<TD>" & _
     cmd.Parameters("UnitPrice").Value & "</TD>")
   Response.Write("</TR>")
   %>
</TABLE>
</BODY>
</HTML>


//