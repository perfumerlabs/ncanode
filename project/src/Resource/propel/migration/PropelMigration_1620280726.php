<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1620280726.
 * Generated on 2021-05-06 05:58:46 by root
 */
class PropelMigration_1620280726
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

ALTER TABLE "ncanode_signature" DROP CONSTRAINT "ncanode_signature_u_51a4c5";

CREATE INDEX "ncanode_signature_i_26266d" ON "ncanode_signature" ("thread","document");

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

DROP INDEX "ncanode_signature_i_26266d";

ALTER TABLE "ncanode_signature" ADD CONSTRAINT "ncanode_signature_u_51a4c5" UNIQUE ("document","thread");

COMMIT;
',
);
    }

}