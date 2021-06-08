create user if not exists phpUser@localhost;
alter user phpUser@localhost
identified by 'DanielleAndDorkaAreMyCuddles';

DROP DATABASE IF EXISTS fastDb;
CREATE DATABASE IF NOT EXISTS fastDb;

ALTER DATABASE fastDb CHARACTER SET utf8 COLLATE utf8_general_ci;

use fastDb;

CREATE TABLE IF NOT EXISTS fast
(
    pk_id INT PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS event
(
    pk_event VARCHAR(200) PRIMARY KEY,
    fk_pk_id INT NOT NULL,

    CONSTRAINT fk_pk_fastevent_id FOREIGN KEY (fk_pk_id) REFERENCES fast (pk_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS therapie
(
    pk_th_id      int primary key auto_increment,
    therapie_name VARCHAR(50),
    fk_pk_id      INT NOT NULL,

    CONSTRAINT fk_pk_fasttherapie_id FOREIGN KEY (fk_pk_id) REFERENCES fast (pk_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS training
(
    pk_tr_id      int primary key auto_increment,
    training_name VARCHAR(50),
    fk_pk_id      INT NOT NULL,

    CONSTRAINT fk_pk_fasttraining_id FOREIGN KEY (fk_pk_id) REFERENCES fast (pk_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS beschreibungTh
(
    pk_beschreibungTh_id INT PRIMARY KEY AUTO_INCREMENT,
    beschreibung         VARCHAR(1000) NOT NULL,
    fk_pk_therapie_id    int           NOT NULL,

    CONSTRAINT fk_therapie_name FOREIGN KEY (fk_pk_therapie_id) REFERENCES therapie (pk_th_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS beschreibungTr
(
    pk_beschreibungTr_id INT PRIMARY KEY AUTO_INCREMENT,
    beschreibung         VARCHAR(1000) NOT NULL,
    fk_pk_training_id    int           NOT NULL,

    CONSTRAINT fk_training_name FOREIGN KEY (fk_pk_training_id) REFERENCES training (pk_tr_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ueber_mich
(
    pk_person_id INT PRIMARY KEY,
    infotext     VARCHAR(10000) NOT NULL,
    fk_pk_id     INT            NOT NULL,

    CONSTRAINT fk_pk_fastueber_mich_id FOREIGN KEY (fk_pk_id) REFERENCES fast (pk_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS termin
(
    pk_datum DATE PRIMARY KEY,
    zeit_von TIME        NOT NULL,
    zeit_bis TIME        NOT NULL,
    location VARCHAR(50) NOT NULL,
    fk_pk_id INT         NOT NULL,

    CONSTRAINT fk_pk_fasttermin_id FOREIGN KEY (fk_pk_id) REFERENCES fast (pk_id) ON DELETE CASCADE
);



INSERT INTO fast(pk_id)
VALUES (1);


INSERT INTO event(pk_event, fk_pk_id)
VALUES ('/events/Event.jpg', 1),
       ('/events/Event1.jpg', 1),
       ('/events/Event2.jpg', 1),
       ('/events/Event3.jpg', 1),
       ('/events/Event4.jpg', 1);

INSERT INTO therapie(pk_th_id, therapie_name, fk_pk_id)
VALUES (1, 'klassische Massage', 1),
       (2, 'Sportmassage', 1),
       (3, 'Faszientherapie', 1),
       (4, 'FUZO', 1),
       (5, 'Lymphdrainage', 1);

INSERT INTO training(pk_tr_id, training_name, fk_pk_id)
VALUES (1, 'Functional Training', 1),
       (2, 'Faszientraining', 1),
       (3, 'Speedtraining', 1),
       (4, 'Testing', 1),
       (5, 'Nutrition, Gewichtsmanagement', 1);


INSERT INTO beschreibungTh(pk_beschreibungTh_id, beschreibung, fk_pk_therapie_id)
VALUES (1, 'Löst Verspannungen und Verkrampfungen in der Muskulatur', 1),
       (2, 'Wohltuend, durchblutungsfördernd', 1),
       (3, 'Entspannung', 1),

       (4, 'Regenerative Massage nach wettkampfmäßiger Belastung', 2),
       (5, 'Behandlung von sportartspezifischen Verletzungen und Restriktionen', 2),
       (6, 'Prävention von Verletzungen durch rechtzeitiges behandeln von Verhärtungen und Verspannung',
        2),
       (7, 'Analyse und Behandlung von strukturellen Problematiken', 2),

       (8, 'Lösen von myofaszialen Triggerpunkten und Adhäsionen', 3),
       (9, 'Myofaszial Taping und foam Rolling', 3),
       (10, 'Segmentmassage', 3),

       (11, 'Die Fußreflexzonenmassage ist vielfältig anwendbar', 4),
       (12, 'Stärkung des Parasympathikus zum Stressabbau', 4),
       (13, 'Gezielte Behandlung von Magen Darmproblematiken', 4),
       (14, 'Vegetativer Ausgleich und Entspannung', 4),

       (15, 'Behandlung von Ödemen nach Sportverletzungen', 5),
       (16, 'Regenerative Drainagen nach schweren wettkampfmäßigen Belastungen zur Vorbeugung von muskulären Problemen',
        5),
       (17, 'Klassische Lymphdrainage zur Behebung von Lymphstauproblematiken', 5),
       (18, 'Stressabbau, Entspannung', 5),
       (19, 'Bei Schlafstörungen', 5);

INSERT INTO beschreibungTr(pk_beschreibungTr_id, beschreibung, fk_pk_training_id)
VALUES (1, 'Kraft, Ausdauer, Balance, Beweglichkeit, Mobiltiy, Propriozeption, ...', 1),
       (2, 'Ziel: Vorbereitung auf persönliche Anforderungen', 1),
       (3, 'Gruppen- oder Einzeltrainings', 1),
       (4, 'Mit Bodyweight Training oder mit Kettlebell, TRX, Gymball, Miniband, Plyobox, Medizinball und Co.',
        1),

       (5, 'Training mit der foam Roll', 2),
       (6, 'Gruppentraining', 2),
       (7, 'Für mehr Mobilität und Range of Motion', 2),
       (8, 'Verletzungsprophylaxe', 2),
       (9, 'Regeneration', 2),

       (10, 'Analyse, Speedcheck, individuell abgestimmte Trainingspläne', 3),
       (11, 'Sportartspezifisches Speedtraining', 2),
       (12, 'Core Performance Training', 2),

       (13, 'Muskuläre Dysbalancen', 3),
       (14, 'Functional Movement Screen', 3),
       (15, 'Muskelfunktionstest', 3),
       (16, 'Kraft, Ausdauer, ROM', 3),
       (17, 'Laufanalyse', 3),

       (18, 'Tipps für die richtige Ernährung in den einzelnen Wettkampfphasen', 4),
       (19, 'Was? braucht der Körper Wann?', 4),
       (20, 'Isst Analyse', 4),
       (21, 'Zielvereinbarung mit Monitoring (Vorher, Nachher)', 4),
       (22, 'Körperfettanalyse, BMI', 4),

       (23, 'Tipps für die richtige Ernährung in den einzelnen Wettkampfphasen', 5),
       (24, 'Was? braucht der Körper Wann?', 5),
       (25, 'Zielvereinbarung mit Monitoring (Vorher, Nachher)', 5),
       (26, 'Körperfettanalyse, BMI', 5);

INSERT INTO ueber_mich(pk_person_id, infotext, fk_pk_id)
VALUES (1,
'WIR SIND FAST
FAscial Sports Therapy

situativ eingesetzte Therapietechniken und eine individuelle Trainingssteuerung helfen Ihnen Ihre Ziele zu erreichen.
Wir vereinen die Therapie mit dem Training und führen unsere Kunden mit individueller Betreuung nach Verletzungen oder Erkrankungen zurück auf die Spur und helfen unterschiedliche Leistungslevel im Sport und Alltag zu steigern und vorbeugend die Gesundheit zu fördern.

„form follows function“ unter diesem Gesichtspunkt zurück zu einem gesunden, ursprünglichen Bewegungsmuster „to bring you on top of your game, where ever you are“
',
        1);

INSERT INTO termin(pk_datum, zeit_von, zeit_bis, location, fk_pk_id)
VALUES ('2021-06-16', '08:00', '11:30', 'Praxis', 1),
       ('2021-06-17', '10:00', '11:00', 'Event', 1),
       ('2021-06-24', '15:00', '16:30', 'Praxis', 1),
       ('2021-06-25', '09:00', '09:30', 'Praxis', 1),
       ('2021-06-29', '10:00', '12:30', 'Event', 1);


grant all on fastDb.* to phpUser@localhost;