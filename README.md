# CoinsAPI

Le Plugin CoinsAPI est une reprise du Plugin EconomyAPI ( by onebone )
Ce plugin permet se recrée une nouvelle economy ( Bientot disponible -> ( Shop, ScoreHud, ScoreBoard ))

Commandes :

setcoins -> Définit le nombre de coins d'un joueur ( Usage : /setcoins )
coins -> Vois le nombre de coins que tu as ( Usage : /coins )
givecoins -> Give des coins au joueurs ( Usage : /givecoins <player> <nombres> )
paycoins -> Envoi des coins aux autres joueurs ( Usage : /paycoins <player> <nombres> )
seecoins -> Vois le nombre de coins des autres joueurs ( Usage : /seecoins <player> )
topcoins -> Vois les 10 joueurs avec le plus de coins dans le serveur ( Usage : /topcoins )
takecoins -> Retirer des coins à des joueurs ( Usage : /takecoins <player> )

Permission :

Perm Admin -> coins.*:
            default: op
setcoins -> coins.setcoins:
            default: op 
coins -> coins.coins:
            default: true
givecoins -> coins.givecoins:
            default: op
paycoins -> coins.paycoins:
            default: true
seecoins -> coins.seecoins:
            default: true
topcoins -> coins.topcoins:
            default: true
takecoins -> coins.takecoins:
            default: op
