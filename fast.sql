DROP DATABASE IF EXISTS fast_db;

CREATE DATABASE IF NOT EXISTS fast_db;

use fast_db;

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
    pk_therapie_name VARCHAR(50) PRIMARY KEY,
    fk_pk_id         INT NOT NULL,

    CONSTRAINT fk_pk_fasttherapie_id FOREIGN KEY (fk_pk_id) REFERENCES fast (pk_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS training
(
    pk_training_name VARCHAR(50) PRIMARY KEY,
    fk_pk_id         INT NOT NULL,

    CONSTRAINT fk_pk_fasttraining_id FOREIGN KEY (fk_pk_id) REFERENCES fast (pk_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS beschreibungTh
(
    pk_beschreibungTh_id INT PRIMARY KEY,
    beschreibung         VARCHAR(1000) NOT NULL,
    fk_pk_therapie_name  VARCHAR(50)   NOT NULL,

    CONSTRAINT fk_pk_therapie_name FOREIGN KEY (fk_pk_therapie_name) REFERENCES therapie (pk_therapie_name) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS beschreibungTr
(
    pk_beschreibungTr_id INT PRIMARY KEY,
    beschreibung         VARCHAR(1000) NOT NULL,
    fk_pk_training_name  VARCHAR(50)   NOT NULL,

    CONSTRAINT fk_pk_training_name FOREIGN KEY (fk_pk_training_name) REFERENCES training (pk_training_name) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ueber_mich (
    pk_person_id INT PRIMARY KEY,
    infotext VARCHAR(10000) NOT NULL,
    fk_pk_id INT NOT NULL,

    CONSTRAINT fk_pk_fastueber_mich_id FOREIGN KEY(fk_pk_id) REFERENCES fast(pk_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS termin (
    pk_datum DATE PRIMARY KEY,
    zeit_von TIME NOT NULL,
    zeit_bis TIME NOT NULL,
    location VARCHAR(50) NOT NULL,
    fk_pk_id INT NOT NULL,

    CONSTRAINT fk_pk_fasttermin_id FOREIGN KEY(fk_pk_id) REFERENCES fast(pk_id) ON DELETE CASCADE
);



INSERT INTO fast(pk_id)
VALUES (1);


INSERT INTO event(pk_event, fk_pk_id)
VALUES ('/images/Event.jpg', 1);

INSERT INTO therapie(pk_therapie_name, fk_pk_id)
VALUES ('klassische Massage', 1),
       ('Sportmassage', 1),
       ('Faszientherapie', 1),
       ('FUZO', 1),
       ('Lymphdrainage', 1);

INSERT INTO training(pk_training_name, fk_pk_id)
VALUES ('Functional Training', 1),
       ('Faszientraining', 1),
       ('Speedtraining', 1),
       ('Testing', 1),
       ('Nutrition, Gewichtsmanagement', 1);


INSERT INTO beschreibungTh(pk_beschreibungTh_id, beschreibung, fk_pk_therapie_name)
VALUES (1, 'löst Verspannungen und Verkrampfungen in der Muskulatur', 'klassische Massage'),
       (2, 'wohltuend, durchblutungsfördernd', 'klassische Massage'),
       (3, 'Entspannung', 'klassische Massage'),

       (4, 'regenerative Massage nach wettkampfmäßiger Belastung', 'Sportmassage'),
       (5, 'Behandlung von sportartspezifischen Verletzungen und Restriktionen', 'Sportmassage'),
       (6, 'Prävention von Verletzungen durch rechtzeitiges behandeln von Verhärtungen und Verspannung', 'Sportmassage'),
       (7, 'Analyse und Behandlung von strukturellen Problematiken', 'Sportmassage'),

       (8, 'lösen von myofaszialen Triggerpunkten und Adhäsionen', 'Faszientherapie'),
       (9, 'Myofaszial Taping und foam Rolling', 'Faszientherapie'),
       (10, 'Segmentmassage', 'Faszientherapie'),

       (11, 'die Fußreflexzonenmassage ist vielfältig anwendbar', 'FUZO'),
       (12, 'Stärkung des Parasympathikus zum Stressabbau', 'FUZO'),
       (13, 'gezielte Behandlung von Magen Darmproblematiken', 'FUZO'),
       (14, 'vegetativer Ausgleich und Entspannung', 'FUZO'),

       (15, 'Behandlung von Ödemen nach Sportverletzungen', 'Lymphdrainage'),
       (16, 'regenerative Drainagen nach schweren wettkampfmäßigen Belastungen zur Vorbeugung von muskulären Problemen', 'Lymphdrainage'),
       (17, 'klassische Lymphdrainage zur Behebung von Lymphstauproblematiken', 'Lymphdrainage'),
       (18, 'Stressabbau, Entspannung', 'Lymphdrainage'),
       (19, 'bei Schlafstörungen', 'Lymphdrainage');

INSERT INTO beschreibungTr(pk_beschreibungTr_id, beschreibung, fk_pk_training_name)
VALUES (1, 'Kraft, Ausdauer, Balance, Beweglichkeit, Mobiltiy, Propriozeption, ...', 'Functional Training'),
       (2, 'Ziel: Vorbereitung auf persönliche Anforderungen', 'Functional Training'),
       (3, 'Gruppen- oder Einzeltrainings', 'Functional Training'),
       (4, 'mit Bodyweight Training oder mit Kettlebell, TRX, Gymball, Miniband, Plyobox, Medizinball und Co.', 'Functional Training'),

       (5, 'Training mit der foam Roll', 'Faszientraining'),
       (6, 'Gruppentraining', 'Faszientraining'),
       (7, 'für mehr Mobilität und Range of Motion', 'Faszientraining'),
       (8, 'Verletzungsprophylaxe', 'Faszientraining'),
       (9, 'Regeneration', 'Faszientraining'),

       (10, 'Analyse, Speedcheck, individuell abgestimmte Trainingspläne', 'Speedtraining'),
       (11, 'sportartspezifisches Speedtraining', 'Speedtraining'),
       (12, 'Core Performance Training', 'Speedtraining'),

       (13, 'Muskuläre Dysbalancen', 'Testing'),
       (14, 'Functional Movement Screen', 'Testing'),
       (15, 'Muskelfunktionstest', 'Testing'),
       (16, 'Kraft, Ausdauer, ROM', 'Testing'),
       (17, 'Laufanalyse', 'Testing'),

       (18, 'Tipps für die richtige Ernährung in den einzelnen Wettkampfphasen', 'Nutrition, Gewichtsmanagement'),
       (19, 'Was? braucht der Körper Wann?', 'Nutrition, Gewichtsmanagement'),
       (20, 'Isst Analyse', 'Nutrition, Gewichtsmanagement'),
       (21, 'Zielvereinbarung mit Monitoring (Vorher, Nachher)', 'Nutrition, Gewichtsmanagement'),
       (22, 'Körperfettanalyse, BMI', 'Nutrition, Gewichtsmanagement');

INSERT INTO ueber_mich(pk_person_id, infotext, fk_pk_id)
VALUES (1, 'Mein Name ist...', 1);

INSERT INTO termin(pk_datum, zeit_von, zeit_bis, location, fk_pk_id)
VALUES ('2021-06-16', '08:00', '11:30', 'Praxis', 1),
       ('2021-06-17', '10:00', '11:00', 'Event', 1),
       ('2021-06-24', '15:00', '16:30', 'Praxis', 1),
       ('2021-06-25', '09:00', '09:30', 'Praxis', 1),
       ('2021-06-29', '10:00', '12:30', 'Event', 1);