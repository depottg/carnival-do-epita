<?php


namespace Hackathon\PlayerIA;


class DepottgPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    // Counting the occurrences of every opponent's choices
    public $opponentRockCount = 0;
    public $opponentPaperCount = 0;
    public $opponentScissorsCount = 0;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        // The positivities are weights used to determine an estimation of the win probability
        // The higher the positivity is, the bigger the win probability is
        $rockPositivity = 0;
        $paperPositivity = 0;
        $scissorsPositivity = 0;

        if ($this->result->getLastChoiceFor($this->opponentSide)) {
            if ($this->result->getLastChoiceFor($this->opponentSide) == parent::rockChoice())
                $this->opponentRockCount++;
            if ($this->result->getLastChoiceFor($this->opponentSide) == parent::paperChoice())
                $this->opponentPaperCount++;
            if ($this->result->getLastChoiceFor($this->opponentSide) == parent::scissorsChoice())
                $this->opponentScissorsCount++;
        }

        if ($this->opponentRockCount + $this->opponentPaperCount + $this->opponentScissorsCount > 0) {
            $rockPositivity = $this->opponentScissorsCount / ($this->opponentRockCount + $this->opponentPaperCount + $this->opponentScissorsCount);
            $paperPositivity = $this->opponentRockCount / ($this->opponentRockCount + $this->opponentPaperCount + $this->opponentScissorsCount);
            $scissorsPositivity = $this->opponentPaperCount / ($this->opponentRockCount + $this->opponentPaperCount + $this->opponentScissorsCount);
        }

        // Final choice and return, based on the positivities
        if ($rockPositivity > $paperPositivity) {
            if ($rockPositivity > $scissorsPositivity) {
                return parent:: rockChoice();
            }
            else  {
                return parent:: scissorsChoice();
            }
        }
        else {
            if ($paperPositivity > $scissorsPositivity) {
                return parent:: paperChoice();
            }
            else  {
                return parent:: scissorsChoice();
            }
        }
    }
};