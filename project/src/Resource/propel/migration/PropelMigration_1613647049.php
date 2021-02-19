<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1613647049.
 * Generated on 2021-02-18 17:17:29 by root
 */
class PropelMigration_1613647049
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

CREATE TABLE "ncanode_signature"
(
    "id" serial NOT NULL,
    "code" VARCHAR(255) NOT NULL,
    "parent_id" INTEGER,
    "signature" TEXT NOT NULL,
    "tags" TEXT,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id"),
    CONSTRAINT "ncanode_signature_u_4db226" UNIQUE ("code")
);

CREATE INDEX "ncanode_signature_i_4db226" ON "ncanode_signature" ("code");

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

DROP TABLE IF EXISTS "ncanode_signature" CASCADE;

COMMIT;
',
);
    }

}