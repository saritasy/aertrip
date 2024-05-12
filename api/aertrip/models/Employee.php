<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $employee_id
 * @property int|null $department_id
 * @property string $employee_name
 * @property string|null $employee_email
 *
 * @property Address[] $addresses
 * @property ContactNumber[] $contactNumbers
 * @property Department $department
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id'], 'integer'],
            [['employee_name'], 'required'],
            [['employee_name', 'employee_email'], 'string', 'max' => 255],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'department_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee ID',
            'department_id' => 'Department ID',
            'employee_name' => 'Employee Name',
            'employee_email' => 'Employee Email',
        ];
    }

    /**
     * Gets query for [[Addresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasOne(Address::class, ['employee_id' => 'employee_id']);
    }

    /**
     * Gets query for [[ContactNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContactNumbers()
    {
        return $this->hasOne(ContactNumber::class, ['employee_id' => 'employee_id']);
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['department_id' => 'department_id']);
    }
}
