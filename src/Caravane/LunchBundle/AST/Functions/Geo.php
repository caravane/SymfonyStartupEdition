<?php

namespace Caravane\LunchBundle\AST\Functions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\Lexer;

class Geo extends FunctionNode
{
    /**
     * @var \Doctrine\ORM\Query\AST\ComparisonExpression
     */
    private $lat;
    /**
     * @var \Doctrine\ORM\Query\AST\ComparisonExpression
     */    
    private $lng;
    
    /**
     * Parse DQL Function
     * 
     * @param Parser $parser 
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->lat = $parser->ComparisonExpression();
        $parser->match(Lexer::T_COMMA);
        $this->lng = $parser->ComparisonExpression();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * Get SQL 
     * 
     * @param SqlWalker $sqlWalker
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker)
    {
    	
		
		/**
		 * TODO: meters vs miles
		 */
		$toMeters=1.609344;
        return sprintf('((ACOS(SIN(%s * PI() / 180) * SIN(%s * PI() / 180) + COS(%s * PI() / 180) * COS(%s * PI() / 180) * COS((%s - %s) * PI() / 180)) * 180 / PI()) * 60 * %s)',
                $this->lat->rightExpression->dispatch($sqlWalker), 
                $this->lat->leftExpression->dispatch($sqlWalker), 
                $this->lat->rightExpression->dispatch($sqlWalker), 
                $this->lat->leftExpression->dispatch($sqlWalker), 
                $this->lng->rightExpression->dispatch($sqlWalker), 
                $this->lng->leftExpression->dispatch($sqlWalker),
                '1.1515 * '.$toMeters);
    }
}