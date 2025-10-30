<?php

declare(strict_types=1);

namespace App\Tests\Manga\Service;

use App\Manga\Service\MangAddictService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\Translation\TranslatorInterface;

class MangAddictServiceTest extends TestCase
{
    private MangAddictService $mangAddictService;
    /** @var TranslatorInterface&MockObject */
    private MockObject $translator;

    protected function setUp(): void
    {
        $this->translator = $this->createMock(TranslatorInterface::class);
        $this->mangAddictService = new MangAddictService($this->translator);
    }
    public function testGreet()
    {
        $this->translator
            ->expects($this->once())
            ->method('trans')
            ->with(
                'app.mangaddict_page.welcome',
                ['%firstName%' => 'Gina']
            )
            ->willReturn('Welcome on MangAddict Gina');
        $this->assertSame('Welcome on MangAddict Gina', $this->mangAddictService->greet('Gina'));
    }

    public function testGreetReturnsString()
    {
        $this->assertIsString($this->mangAddictService->greet('Raymond'));
    }

    public function testInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('First name must not be empty.');

        $this->mangAddictService->greet('');
    }
}
