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

    // Gets the symbol winning on the given symbol
    private function GetWinner($symbol) {
        if ($symbol == parent::rockChoice())
            return parent::paperChoice();
        if ($symbol == parent::paperChoice())
            return parent::scissorsChoice();
        return parent::rockChoice();
    }

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

        // Counting all the inputs of the opponent to make statistics
        if ($this->result->getLastChoiceFor($this->opponentSide)) {
            if ($this->result->getLastChoiceFor($this->opponentSide) == parent::rockChoice())
                $this->opponentRockCount++;
            if ($this->result->getLastChoiceFor($this->opponentSide) == parent::paperChoice())
                $this->opponentPaperCount++;
            if ($this->result->getLastChoiceFor($this->opponentSide) == parent::scissorsChoice())
                $this->opponentScissorsCount++;
        }

        // Finding the win statistical probability of every move
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

        // C'est l'histoire de trois vampires qui parlent, tranquillement, entre amis.

        // Le premier vampire dit :
        // - Je suis le vampire le plus rapide de la Terre, regardez ce que je sais faire !
        // Il part en courrant à une vitesse surréaliste.
        // Il revient une seconde après, la bouche pleine de sang, et dit :
        // - Vous voyez la maison là-bas ? En une seconde je suis parti, j'ai tué ses quatre habitants, j'ai bu leur sang et je suis revenu.

        // Le deuxième vampire lui dit :
        // - Quel naze ! Je suis largement plus rapide que ça ! Voyez plutôt.
        // Il part à une vitesse supérieure à Mach 2, et revient un dixième de seconde après, le visage plein de sang. Il dit :
        // - Vous voyez le village là-bas ? En un dixième de seconde je suis parti, j'ai tué ses 50 habitants, j'ai bu tout leur sang et je suis revenu !

        // Le troisième dit :
        // - Y'en a pas un pour rattraper l'autre, ma grand-mère morte va plus vite ! Regardez ce que je sais faire, moi, le vampire le plus rapide de l'univers !
        // Il part tellement vite que la route s'embrase, et il revient un millionième de seconde plus tard, couvert de sang. Il dit :
        // - Vous voyez l'arbre là-bas ? Ben moi je l'avais pas vu...
    }
};