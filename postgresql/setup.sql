
CREATE TABLE perguntas(
    idPergunta  SERIAL PRIMARY KEY NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    dificuldade VARCHAR(20) NOT NULL,
    pergunta VARCHAR(500) NOT NULL,
    respostaCorreta VARCHAR(100) NOT NULL,
    respostasIncorretas VARCHAR(100) NOT NULL
);


CREATE TABLE jogadas(
    idJogada SERIAL PRIMARY KEY NOT NULL,
    idJogo INT NOT NULL,
    idJogador INT NOT NULL,
    nomeJogador VARCHAR(50) NOT NULL,
    acerto BOOLEAN NOT NULL,
    idPergunta INT NOT NULL,
    FOREIGN KEY (idPergunta) REFERENCES perguntas(idPergunta)
);


/*
*Jogadas*
ID da jogada
ID do jogo
ID do jogador
Nome do jogador
ID da pergunta (estrangeira)
Se acertou ou errou (boolean)

*Perguntas*
ID da pergunta (int serial)
Pergunta (varchar)
Resposta correta
Respostas incorretas
Resposta do jogador

Tipo de resposta esperada:
{
    "response_code": 0,
    "results": [
        {
            "type": "multiple",
            "difficulty": "medium",
            "category": "Entertainment: Video Games",
            "question": "How many games are there in the &quot;Colony Wars&quot; series for the PlayStation?",
            "correct_answer": "3",
            "incorrect_answers": [
                "2",
                "4",
                "5"
            ]
        },
        {
            "type": "multiple",
            "difficulty": "medium",
            "category": "Entertainment: Comics",
            "question": "What is the name of the main character in the webcomic Gunnerkrigg Court by Tom Siddell?",
            "correct_answer": "Antimony",
            "incorrect_answers": [
                "Bismuth",
                "Mercury",
                "Cobalt"
            ]
        },
        {
            "type": "boolean",
            "difficulty": "easy",
            "category": "Science: Computers",
            "question": "The logo for Snapchat is a Bell.",
            "correct_answer": "False",
            "incorrect_answers": [
                "True"
            ]
        },
        {
            "type": "multiple",
            "difficulty": "medium",
            "category": "Entertainment: Music",
            "question": "From which album is the Gorillaz song, &quot;On Melancholy Hill&quot; featured in?",
            "correct_answer": "Plastic Beach",
            "incorrect_answers": [
                "Demon Days",
                "Humanz",
                "The Fall"
            ]
        },
        {
            "type": "multiple",
            "difficulty": "hard",
            "category": "Entertainment: Video Games",
            "question": "In Disney&#039;s &quot;Toontown Online&quot;, which of these species wasn&#039;t available as a Toon?",
            "correct_answer": "Cow",
            "incorrect_answers": [
                "Monkey",
                "Bear",
                "Pig"
            ]
        }
    ]
}
*/