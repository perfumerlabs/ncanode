<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1620274372.
 * Generated on 2021-05-06 04:12:52 by root
 */
class PropelMigration_1620274372
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

CREATE TABLE "ncanode_signature_version"
(
    "id" INTEGER NOT NULL,
    "document" VARCHAR(255) NOT NULL,
    "thread" VARCHAR(255) NOT NULL,
    "signature" TEXT NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "version" INTEGER DEFAULT 0 NOT NULL,
    "version_created_at" TIMESTAMP,
    "version_created_by" VARCHAR(100),
    "version_comment" VARCHAR(255),
    PRIMARY KEY ("id","version")
);

ALTER TABLE "ncanode_signature" DROP CONSTRAINT "ncanode_signature_fk_fd9685";

DROP INDEX "ncanode_signature_i_af4d9f";

ALTER TABLE "ncanode_signature" DROP CONSTRAINT "ncanode_signature_u_0bb977";

ALTER TABLE "ncanode_signature" DROP CONSTRAINT "ncanode_signature_u_3f5e93";

ALTER TABLE "ncanode_signature" RENAME COLUMN "chain" TO "version_comment";

ALTER TABLE "ncanode_signature"

  ADD "thread" VARCHAR(255) NOT NULL,

  ADD "version" INTEGER DEFAULT 0,

  ADD "version_created_at" TIMESTAMP,

  ADD "version_created_by" VARCHAR(100),

  DROP COLUMN "parent_id",

  DROP COLUMN "stage";

ALTER TABLE "ncanode_signature" ADD CONSTRAINT "ncanode_signature_u_51a4c5" UNIQUE ("document","thread");

ALTER TABLE "ncanode_signature_tag" DROP CONSTRAINT "ncanode_signature_tag_u_a8f220";

ALTER TABLE "ncanode_signature_tag"

  DROP CONSTRAINT "ncanode_signature_tag_pkey",

  DROP COLUMN "id",

  ADD PRIMARY KEY ("signature_id","tag_id");

DROP INDEX "ncanode_tag_i_4db226";

ALTER TABLE "ncanode_signature_version" ADD CONSTRAINT "ncanode_signature_version_fk_e24b62"
    FOREIGN KEY ("id")
    REFERENCES "ncanode_signature" ("id")
    ON DELETE CASCADE;

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

DROP TABLE IF EXISTS "ncanode_signature_version" CASCADE;

ALTER TABLE "ncanode_signature" DROP CONSTRAINT "ncanode_signature_u_51a4c5";

ALTER TABLE "ncanode_signature" RENAME COLUMN "version_comment" TO "chain";

ALTER TABLE "ncanode_signature"

  ADD "parent_id" INTEGER,

  ADD "stage" VARCHAR(255),

  DROP COLUMN "thread",

  DROP COLUMN "version",

  DROP COLUMN "version_created_at",

  DROP COLUMN "version_created_by";

CREATE INDEX "ncanode_signature_i_af4d9f" ON "ncanode_signature" ("document","chain");

ALTER TABLE "ncanode_signature" ADD CONSTRAINT "ncanode_signature_u_0bb977" UNIQUE ("parent_id");

ALTER TABLE "ncanode_signature" ADD CONSTRAINT "ncanode_signature_u_3f5e93" UNIQUE ("document","chain","stage");

ALTER TABLE "ncanode_signature" ADD CONSTRAINT "ncanode_signature_fk_fd9685"
    FOREIGN KEY ("parent_id")
    REFERENCES "ncanode_signature" ("id");

ALTER TABLE "ncanode_signature_tag"

  DROP CONSTRAINT "ncanode_signature_tag_pkey",

  ADD "id" serial NOT NULL,

  ADD PRIMARY KEY ("id");

ALTER TABLE "ncanode_signature_tag" ADD CONSTRAINT "ncanode_signature_tag_u_a8f220" UNIQUE ("signature_id","tag_id");

CREATE INDEX "ncanode_tag_i_4db226" ON "ncanode_tag" ("code");

COMMIT;
',
);
    }

}