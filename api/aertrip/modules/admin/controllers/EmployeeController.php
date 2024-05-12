<?php

namespace app\modules\admin\controllers;

use app\models\Address;
use app\models\ContactNumber;
use app\models\Department;
use app\models\Employee;
use Yii;
use yii\db\Query;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Employeecontroller for the `admin` module
 */
class EmployeeController extends ActiveController
{
   public $modelClass ="app\models\Employee";


   /**
     * {@inheritdoc}
     */
    public function actions()
    {
         $actions = parent::actions();
         $actions['List'] = [
            'class' => 'app\actions\ListAction',
         ];
         $actions['UpdateEmployee'] = [
            'class' => 'app\actions\UpdateEmployeeAction',
         ];

         $actions['CreateEmployee'] = [
            'class' => 'app\actions\CreateEmployeeAction',
         ];

         $actions['DeleteEmployee'] = [
            'class' => 'app\actions\DeleteEmployeeAction',
         ];

        return $actions;
    }

    /**
     * {@inheritdoc}
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }


    public function actionList()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $query = (new Query())
      ->select([
         'e.employee_id',
         'e.department_id',
         'e.employee_name',
         'e.employee_email',
         'd.department_id AS department_id',
         'd.department_name AS department_name',
         'a.address_id',
         'a.employee_id AS address_employee_id',
         'a.address_line_1',
         'a.address_line_2',
         'a.city',
         'a.state',
         'a.country',
         'a.postal_code',
         'c.contact_id',
         'c.employee_id AS contact_employee_id',
         'c.contact_number',
      ])
      ->from('employee e')
      ->leftJoin('department d', 'e.department_id = d.department_id')
      ->leftJoin('address a', 'e.employee_id = a.employee_id')
      ->leftJoin('contact_number c', 'e.employee_id = c.employee_id');

      // Execute the query
      $employees = $query->all();
      // return $employees;
      $formattedEmployees = [];

      foreach ($employees as $employeeData) {
         // Extract employee details
         $employeeId = $employeeData['employee_id'];
         $departmentId = $employeeData['department_id'];
         $employeeName = $employeeData['employee_name'];
         $employeeEmail = $employeeData['employee_email'];
         $departmentName = $employeeData['department_name'];

         // Build employee data structure
         $employee = [
            'employee_id' => $employeeId,
            'department_id' => $departmentId,
            'employee_name' => $employeeName,
            'employee_email' => $employeeEmail,
            'department' => [
                  'department_id' => $departmentId,
                  'department_name' => $departmentName,
            ],
            'address' => [],
            'contact_number' => [],
         ];

         // Extract and format address details
         if (!empty($employeeData['address_id'])) {
            $address = [
                  'address_id' => $employeeData['address_id'],
                  'employee_id' => $employeeId,
                  'address_line_1' => $employeeData['address_line_1'],
                  'address_line_2' => $employeeData['address_line_2'],
                  'city' => $employeeData['city'],
                  'state' => $employeeData['state'],
                  'country' => $employeeData['country'],
                  'postal_code' => $employeeData['postal_code'],
            ];
            $employee['address'][] = $address;
         }

         // Extract and format contact number details
         if (!empty($employeeData['contact_id'])) {
            $contactNumber = [
                  'contact_id' => $employeeData['contact_id'],
                  'employee_id' => $employeeId,
                  'contact_number' => $employeeData['contact_number'],
            ];
            $employee['contact_number'][] = $contactNumber;
         }

         // Add formatted employee data to the result array
         $formattedEmployees[] = $employee;
      }

      // Output or further process $formattedEmployees as needed
      return $formattedEmployees;
    }


    public function actionUpdateEmployee()
   {
      Yii::$app->response->format = Response::FORMAT_JSON;

      try {
         $postData = Yii::$app->request->rawBody;
         Yii::debug('Raw POST Data: ' . $postData);

         $employeeData = json_decode($postData, true);
         if ($employeeData === null) {
               throw new BadRequestHttpException('Invalid JSON data.');
         }

         // Validate required fields
         if (!isset($employeeData['employee_id'])) {
               throw new BadRequestHttpException('Employee ID is required.');
         }

         // Find the employee record to update
         $employeeId = $employeeData['employee_id'];
         $employee = Employee::findOne($employeeId);
         if (!$employee) {
               throw new NotFoundHttpException('Employee not found.');
         }

         // Update employee details
         $employee->employee_name = $employeeData['employee_name'] ?? $employee->employee_name;
         $employee->employee_email = $employeeData['employee_email'] ?? $employee->employee_email;

         // Save the employee record
         if (!$employee->save()) {
               throw new \Exception('Failed to update employee details.');
         }

         // Update department if provided
         if (isset($employeeData['department'])) {
               $departmentData = $employeeData['department'];
               $departmentId = $departmentData['department_id'] ?? null;
               if ($departmentId !== null) {
                  $department = Department::findOne($departmentId);
                  if ($department) {
                     $department->department_name = $departmentData['department_name'] ?? $department->department_name;
                     $department->save();
                  }
               }
         }

         // Update or create address records
         if (isset($employeeData['address']) && is_array($employeeData['address'])) {
               foreach ($employeeData['address'] as $addressItem) {
                  $addressId = $addressItem['address_id'] ?? null;
                  $address = $addressId ? Address::findOne($addressId) : new Address();
                  if ($address) {
                     $address->employee_id = $employeeId;
                     $address->attributes = $addressItem;
                     $address->save();
                  }
               }
         }

         // Update or create contact number records
         if (isset($employeeData['contact_number']) && is_array($employeeData['contact_number'])) {
               foreach ($employeeData['contact_number'] as $contactItem) {
                  $contactId = $contactItem['contact_id'] ?? null;
                  $contact = $contactId ? ContactNumber::findOne($contactId) : new ContactNumber();
                  if ($contact) {
                     $contact->employee_id = $employeeId;
                     $contact->attributes = $contactItem;
                     $contact->save();
                  }
               }
         }

         // Prepare success response
         $response = [
               'success' => true,
               'message' => 'Employee data updated successfully.',
               'employee' => $employee->attributes, // Include updated employee data in response
         ];
      } catch (\Throwable $e) {
         // Log the error for debugging purposes
         Yii::error('Error updating employee: ' . $e->getMessage());

         // Prepare error response
         $response = [
               'success' => false,
               'message' => 'Failed to update employee data. ' . $e->getMessage(),
         ];
      }

      return $response;
   }


   public function actionCreateEmployee()
   {
      Yii::$app->response->format = Response::FORMAT_JSON;

      $postData = Yii::$app->request->rawBody;
      $employeeData = json_decode($postData, true);

      if ($employeeData === null) {
         throw new BadRequestHttpException('Invalid JSON data.');
      }

      $transaction = Yii::$app->db->beginTransaction();

      try {
         // Create Department
         $departmentData = $employeeData['department'];
         $departmentId = $departmentData['department_id'];
         $department = Department::findOne($departmentId);
         if (!$department) {
               $department = new Department();
               $department->department_id = $departmentId;
               $department->department_name = $departmentData['department_name'];
               if (!$department->save()) {
                  throw new \Exception('Failed to create department.');
               }
         }

         // Create Employee
         $employee = new Employee();
         $employee->employee_id = $employeeData['employee_id'];
         $employee->employee_name = $employeeData['employee_name'];
         $employee->employee_email = $employeeData['employee_email'];
         $employee->department_id = $departmentId;
         if (!$employee->save()) {
               throw new \Exception('Failed to create employee.');
         }

         // Create Address(es)
         $addressesData = $employeeData['address'];
         foreach ($addressesData as $addressItem) {
               $address = new Address();
               $address->employee_id = $employee->employee_id;
               $address->attributes = $addressItem;
               if (!$address->save()) {
                  throw new \Exception('Failed to create address.');
               }
         }

         // Create Contact Number(s)
         $contactNumbersData = $employeeData['contact_number'];
         foreach ($contactNumbersData as $contactItem) {
               $contact = new ContactNumber();
               $contact->employee_id = $employee->employee_id;
               $contact->attributes = $contactItem;
               if (!$contact->save()) {
                  throw new \Exception('Failed to create contact number.');
               }
         }

         $transaction->commit();

         // Prepare success response
         $response = [
               'success' => true,
               'message' => 'Employee and related records created successfully.',
               'employee' => $employee->attributes,
         ];
      } catch (\Throwable $e) {
         $transaction->rollBack();

         // Log the error for debugging purposes
         Yii::error('Error creating employee: ' . $e->getMessage());

         // Prepare error response
         $response = [
               'success' => false,
               'message' => 'Failed to create employee and related records. ' . $e->getMessage(),
         ];
      }

      return $response;
   }

   public function actionDeleteEmployee($employee_id)
   {
       Yii::$app->response->format = Response::FORMAT_JSON;
   
       $transaction = Yii::$app->db->beginTransaction();
   
       try {
           // Find the employee record to delete
           $employee = Employee::findOne($employee_id);
           if (!$employee) {
               throw new NotFoundHttpException('Employee not found.');
           }
   
           // Delete associated address records
        Address::deleteAll(['employee_id' => $employee->employee_id]);

        // Delete associated contact number records
        ContactNumber::deleteAll(['employee_id' => $employee->employee_id]);

        // Delete the employee record
        $employee->delete();

        // Commit transaction if all deletions are successful
        $transaction->commit();
   
           // Prepare success response
           $response = [
               'success' => true,
               'message' => 'Employee and associated records deleted successfully.',
           ];
       } catch (\Throwable $e) {
           // Roll back transaction on error
           $transaction->rollBack();
   
           // Log the error for debugging purposes
           Yii::error('Error deleting employee: ' . $e->getMessage());
   
           // Prepare error response
           $response = [
               'success' => false,
               'message' => 'Failed to delete employee and associated records. ' . $e->getMessage(),
           ];
       }
   
       return $response;
   }

}
