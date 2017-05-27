<?php

namespace Iris\Credentials;

use DB;

class Permissions
{
    /**
     * @var DB
     */
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param string $tableName For example: {email}
     * @param string $recordId GUID
     * @param int|null $userId Current user by defaults
     * @return bool
     */
    public function canRead($tableName, $recordId, $userId = null)
    {
        return $this->can('r', $tableName, $recordId, $userId);
    }

    /**
     * @param string $tableName For example: {email}
     * @param string $recordId GUID
     * @param int|null $userId Current user by defaults
     * @return bool
     */
    public function canWrite($tableName, $recordId, $userId = null)
    {
        return $this->can('w', $tableName, $recordId, $userId);
    }

    /**
     * @param string $tableName For example: {email}
     * @param string $recordId GUID
     * @param int|null $userId Current user by defaults
     * @return bool
     */
    public function canDelete($tableName, $recordId, $userId = null)
    {
        return $this->can('d', $tableName, $recordId, $userId);
    }

    /**
     * @param string $tableName For example: {email}
     * @param string $recordId GUID
     * @param int|null $userId Current user by defaults
     * @return bool
     */
    public function canChangePermissions($tableName, $recordId, $userId = null)
    {
        return $this->can('a', $tableName, $recordId, $userId);
    }

    /**
     * @param string $action r, w, a, d
     * @param string $tableName For example: {email}
     * @param string $recordId GUID
     * @param int|null $userId Current user by defaults
     * @return bool
     */
    protected function can($action, $tableName, $recordId, $userId = null)
    {
        if (!$userId) {
            $userId = GetUserId();
        }
        if (GetUserRecordPermissions($this->db->tableName($tableName), $recordId, $userId, $permissions) !== 0) {
            return false;
        }

        return $permissions[$action];
    }
}