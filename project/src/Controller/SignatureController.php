<?php

namespace Ncanode\Controller;

use Ncanode\Domain\SignatureDomain;
use Ncanode\Model\Map\SignatureTableMap;
use Ncanode\Model\SignatureQuery;
use Ncanode\Repository\SignatureRepository;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;

class SignatureController extends LayoutController
{
    public function get()
    {
        $id   = (int) $this->f('id');
        $code = $this->f('code');
        $tags = $this->f('tags');

        if (!$id && !$code && !$tags) {
            $this->forward('error', 'badRequest', [$this->t('error.id_code_tags_must_be_set')]);
        }

        $obj = null;

        if ($id) {
            $obj = SignatureQuery::create()
                ->findPk($id);
        }

        if ($code) {
            $obj = SignatureQuery::create()
                ->findOneByCode($code);
        }

        //find last signature by tags
        if ($tags) {
            if (!is_array($tags)) {
                $tags = [$tags];
            }

            $obj = SignatureQuery::create()
                ->filterByTags($tags, Criteria::CONTAINS_SOME)
                ->orderByCreatedAt(Criteria::DESC)
                ->findOne();
        }

        if (!$obj) {
            $this->forward('error', 'badRequest', [$this->t('error.signature_not_found')]);
        }

        /** @var SignatureRepository $repository */
        $repository = $this->s('ncanode.repository.signature');

        $this->setContent(
            [
                'signature' => $repository->format($obj),
            ]
        );
    }

    public function post()
    {
        $code      = $this->f('code');
        $parent    = $this->f('parent');
        $signature = $this->f('signature');
        $tags      = $this->f('tags');

        $this->validateNotEmpty($code, 'code');
        $this->validateNotEmpty($signature, 'signature');

        $exist_obj = SignatureQuery::create()
            ->filterByCode($code)
            ->exists();

        if ($exist_obj) {
            $this->forward('error', 'badRequest', [$this->t('error.signature_code_exists')]);
        }

        /** @var SignatureDomain $domain */
        $domain = $this->s('ncanode.domain.signature');

        $con = Propel::getConnection(SignatureTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $domain->save(
                [
                    'code'      => $code,
                    'parent'    => $parent,
                    'signature' => $signature,
                    'tags'      => $tags,
                ]
            );

            $con->commit();
        } catch (\Throwable $e) {
            $con->rollBack();
        }
    }

    public function patch()
    {
        $id        = $this->f('id');
        $code      = $this->f('code');
        $parent    = $this->f('parent');
        $signature = $this->f('signature');
        $tags      = $this->f('tags');

        $this->validateNotEmpty($id, 'id');

        /** @var SignatureDomain $domain */
        $domain = $this->s('ncanode.domain.signature');

        $con = Propel::getConnection(SignatureTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $domain->save(
                [
                    'id'        => $id,
                    'code'      => $code,
                    'parent'    => $parent,
                    'signature' => $signature,
                    'tags'      => $tags,
                ]
            );

            $con->commit();
        } catch (\Throwable $e) {
            $con->rollBack();
        }
    }

    public function delete()
    {
        $id = (int) $this->f('id');

        $this->validateNotEmpty($id, 'id');

        /** @var SignatureDomain $domain */
        $domain = $this->s('ncanode.domain.signature');

        $con = Propel::getConnection(SignatureTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $domain->delete($id);

            $con->commit();
        } catch (\Throwable $e) {
            $con->rollBack();
        }
    }
}
