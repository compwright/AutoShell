<?php
namespace AutoShell;

class ManualTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp() : void
    {
        $this->format = new Format();
        $this->manual = new Manual();
    }

    public function testBasic()
    {
        $actual = trim($this->format->strip(
            ($this->manual)(
                'foo-bar:dib',
                Fake\Command\FooBar\Dib::CLASS,
                '__invoke'
            )
        ));

        $expect = trim(<<<TEXT
NAME
    foo-bar:dib -- Dibs an i, with optional alpha, bravo, and charlie behaviors.

SYNOPSIS
    foo-bar:dib [options] [--] i [k]

ARGUMENTS
    i
        The i to be dibbed

    k (default: 'kay')
         No help available.

OPTIONS
    -a
    --alpha
        The alpha option.

    -b bval
    --bravo=bval
        No help available.

    -c [value] (default: 'delta')
    --charlie[=value] (default: 'delta')
        No help available.

DESCRIPTION
    This is a description of the command.

    There are quite a few nuances.

EXAMPLES
    Here are some examples of how use the command.

    Please use your imagination.

TEXT);
        $this->assertSame($expect, $actual);
    }

    public function testNoOptionsNoArguments()
    {
        $actual = trim($this->format->strip(
            ($this->manual)(
                'foo-bar:qux',
                Fake\Command\FooBar\Qux::CLASS,
                '__invoke'
            )
        ));

        $expect = trim(<<<TEXT
NAME
    foo-bar:qux -- Command for qux operations.

SYNOPSIS
    foo-bar:qux
TEXT);

        $this->assertSame($expect, $actual);
    }

    public function testVariadicArguments()
    {
        $actual = trim($this->format->strip(
            ($this->manual)(
                'foo-bar:baz',
                Fake\Command\FooBar\Baz::CLASS,
                '__invoke'
            )
        ));

        $expect = trim(<<<TEXT
NAME
    foo-bar:baz

SYNOPSIS
    foo-bar:baz [options] [--] i [tail] ...

ARGUMENTS
    i
         No help available.

    tail
         No help available.

OPTIONS
    -z
    --zim
        No help available.
TEXT);

        $this->assertSame($expect, $actual);
    }
}
