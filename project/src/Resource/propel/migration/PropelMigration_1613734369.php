<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1613734369.
 * Generated on 2021-02-19 17:32:49 by root
 */
class PropelMigration_1613734369
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

CREATE TABLE "ncanode_tag"
(
    "id" serial NOT NULL,
    "code" VARCHAR(255) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id"),
    CONSTRAINT "ncanode_tag_u_4db226" UNIQUE ("code")
);

CREATE INDEX "ncanode_tag_i_4db226" ON "ncanode_tag" ("code");

CREATE TABLE "ncanode_signature_tag"
(
    "id" serial NOT NULL,
    "signature_id" INTEGER NOT NULL,
    "tag_id" INTEGER NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id"),
    CONSTRAINT "ncanode_signature_tag_u_a8f220" UNIQUE ("signature_id","tag_id")
);

DROP INDEX "ncanode_signature_i_4db226";

ALTER TABLE "ncanode_signature" DROP CONSTRAINT "ncanode_signature_u_4db226";

ALTER TABLE "ncanode_signature" RENAME COLUMN "code" TO "document";

ALTER TABLE "ncanode_signature"

  ADD "chain" VARCHAR(255),

  ADD "stage" VARCHAR(255),

  DROP COLUMN "tags";

CREATE INDEX "ncanode_signature_i_af4d9f" ON "ncanode_signature" ("document","chain");

ALTER TABLE "ncanode_signature" ADD CONSTRAINT "ncanode_signature_u_3f5e93" UNIQUE ("document","chain","stage");

ALTER TABLE "ncanode_signature_tag" ADD CONSTRAINT "ncanode_signature_tag_fk_51f38c"
    FOREIGN KEY ("signature_id")
    REFERENCES "ncanode_signature" ("id")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "ncanode_signature_tag" ADD CONSTRAINT "ncanode_signature_tag_fk_afad90"
    FOREIGN KEY ("tag_id")
    REFERENCES "ncanode_tag" ("id")
    ON UPDATE CASCADE
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

DROP TABLE IF EXISTS "ncanode_tag" CASCADE;

DROP TABLE IF EXISTS "ncanode_signature_tag" CASCADE;

DROP INDEX "ncanode_signature_i_af4d9f";

ALTER TABLE "ncanode_signature" DROP CONSTRAINT "ncanode_signature_u_3f5e93";

ALTER TABLE "ncanode_signature" RENAME COLUMN "document" TO "code";

ALTER TABLE "ncanode_signature"

  ADD "tags" TEXT,

  DROP COLUMN "chain",

  DROP COLUMN "stage";

CREATE INDEX "ncanode_signature_i_4db226" ON "ncanode_signature" ("code");

ALTER TABLE "ncanode_signature" ADD CONSTRAINT "ncanode_signature_u_4db226" UNIQUE ("code");

COMMIT;
',
);
    }

}