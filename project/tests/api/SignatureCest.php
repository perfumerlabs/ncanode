<?php

use Perfumer\Helper\Text;

class SignatureCest
{
    public function _before(\ApiTester $I)
    {
    }

    // tests
    public function tryToTest(\ApiTester $I)
    {
        $document = Text::generateString();
        $thread = Text::generateString();
        $cms = Text::generateString();
        $version_comment = Text::generateString();
        $version_created_by = Text::generateString();
        $tags = [Text::generateString(), Text::generateString()];

        // сохраняем 1 раз
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/signature', [
            'document' => $document,
            'thread' => $thread,
            'cms' => $cms,
            'tags' => $tags,
            'version_comment' => $version_comment,
            'version_created_by' => $version_created_by,
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'content' => [
                'signature' => [
                    'version' => 1,
                    'document' => $document,
                    'thread' => $thread,
                    'cms' => $cms,
                    'tags' => $tags,
                    'version_comment' => $version_comment,
                    'version_created_by' => $version_created_by,
                ]
            ]
        ]);

        // вытаскиваем из базы
        $I->sendGet('/signature', [
            'document' => $document,
            'thread' => $thread,
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'content' => [
                'signature' => [
                    'version' => 1,
                    'document' => $document,
                    'thread' => $thread,
                    'cms' => $cms,
                    'tags' => $tags,
                    'version_comment' => $version_comment,
                    'version_created_by' => $version_created_by,
                ]
            ]
        ]);

        // сохраняем 2 раз
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/signature', [
            'document' => $document,
            'thread' => $thread,
            'cms' => $cms,
            'tags' => $tags,
            'version_comment' => $version_comment,
            'version_created_by' => $version_created_by,
            'version' => 1,
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'content' => [
                'signature' => [
                    'version' => 2,
                    'document' => $document,
                    'thread' => $thread,
                    'cms' => $cms,
                    'tags' => $tags,
                    'version_comment' => $version_comment,
                    'version_created_by' => $version_created_by,
                ]
            ]
        ]);

        // вытаскиваем из базы
        $I->sendGet('/signature', [
            'document' => $document,
            'thread' => $thread,
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'content' => [
                'signature' => [
                    'version' => 2,
                    'document' => $document,
                    'thread' => $thread,
                    'cms' => $cms,
                    'tags' => $tags,
                    'version_comment' => $version_comment,
                    'version_created_by' => $version_created_by,
                ]
            ]
        ]);

        // сохраняем 3 раз с неверной версией
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/signature', [
            'document' => $document,
            'thread' => $thread,
            'cms' => $cms,
            'tags' => $tags,
            'version_comment' => $version_comment,
            'version_created_by' => $version_created_by,
            'version' => 1,
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);

        // Удаляем
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendDelete('/signature', [
            'document' => $document,
            'thread' => $thread,
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();

        // заново вытаскиваем его и проверяем, что его нет
        $I->sendGet('/signature', [
            'document' => $document,
            'thread' => $thread,
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::NOT_FOUND);
    }
}
