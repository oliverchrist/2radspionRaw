ALTER TABLE  `bike` ADD  `radtyp` INT NOT NULL AFTER  `pid` ,
ADD  `geschlecht` INT NOT NULL AFTER  `radtyp` ,
ADD  `zustand` INT NOT NULL AFTER  `geschlecht` ,
ADD  `laufleistung` INT NOT NULL AFTER  `zustand` ,
ADD  `radgroesse` INT NOT NULL AFTER  `laufleistung` ,
ADD  `rahmenhoehe` INT NOT NULL AFTER  `radgroesse`


ALTER TABLE  `bike` ADD  `farbe` INT NOT NULL AFTER  `modell` ,
ADD  `bremssystem` INT NOT NULL AFTER  `farbe` ,
ADD  `schaltungstyp` INT NOT NULL AFTER  `bremssystem` ,
ADD  `rahmenfarbe` INT NOT NULL AFTER  `schaltungstyp` ,
ADD  `beleuchtungsart` INT NOT NULL AFTER  `rahmenfarbe` ,
ADD  `einsatzbereich` INT NOT NULL AFTER  `beleuchtungsart`