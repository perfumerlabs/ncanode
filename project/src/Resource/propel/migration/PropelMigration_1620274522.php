<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1620274522.
 * Generated on 2021-05-06 04:15:22 by root
 */
class PropelMigration_1620274522
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'ncanode' => '
BEGIN;

ALTER TABLE "ncanode_signature" RENAME COLUMN "signature" TO "cms";

ALTER TABLE "ncanode_signature_version" RENAME COLUMN "signature" TO "cms";

COMMIT;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'ncanode' => '
BEGIN;

ALTER TABLE "ncanode_signature" RENAME COLUMN "cms" TO "signature";

ALTER TABLE "ncanode_signature_version" RENAME COLUMN "cms" TO "signature";

COMMIT;
',
);
    }

}