<?php
namespace DoctrineExtensions\Query\Postgres;

use Doctrine\ORM\Query\AST\Functions\FunctionNode,
Doctrine\ORM\Query\Lexer;

class Floor
{
    private $number;
    
    /**
     * @override
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return "FLOOR( " . $sqlWalker->walkArithmeticPrimary($this->number) . ")";
    }

    /**
     * @override
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->number = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}