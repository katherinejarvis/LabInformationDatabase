CREATE DATABASE LaboratoryData DEFAULT CHARACTER SET utf8;

USE LaboratoryData; (Command Line Only)

CREATE TABLE Department (
  department_id INTEGER NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY(department_id)
) ENGINE = InnoDB CHARACTER SET=utf8mb4;

CREATE TABLE Scientist (
  scientist_id INTEGER NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  manager VARCHAR(255),
  department_id INTEGER,
  PRIMARY KEY(scientist_id),
  CONSTRAINT FOREIGN KEY (department_id) REFERENCES Department(department_id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET=utf8mb4;

CREATE TABLE SOP (
  sop_id INTEGER NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  benchling_id VARCHAR(255),
  PRIMARY KEY(sop_id)
) ENGINE = InnoDB CHARACTER SET=utf8mb4;

CREATE TABLE BenchlingExp (
  benchling_id INTEGER NOT NULL AUTO_INCREMENT,
  benchlingexp_id VARCHAR(255),
  PRIMARY KEY(benchling_id)
) ENGINE = InnoDB CHARACTER SET=utf8mb4;

CREATE TABLE BriefDesc (
  desc_id INTEGER NOT NULL AUTO_INCREMENT,
  description VARCHAR(255),
  fulldesc TEXT,
  PRIMARY KEY(desc_id)
) ENGINE = InnoDB CHARACTER SET=utf8mb4;

CREATE TABLE Program (
  program_id INTEGER NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY(program_id)

) ENGINE = InnoDB CHARACTER SET=utf8mb4;

CREATE TABLE Results (
  result_id INTEGER NOT NULL AUTO_INCREMENT,
  Done INTEGER,
  data LONGBLOB,
  DriveLocation VARCHAR(255),
  PRIMARY KEY(result_id)

) ENGINE = InnoDB CHARACTER SET=utf8mb4;

CREATE TABLE Experiments (
  experiment_id INTEGER NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  benchling_id INTEGER,
  desc_id INTEGER,
  scientist_id INTEGER,
  program_id INTEGER,
  date INTEGER,
  result_id INTEGER,
  sop_id INTEGER,

  PRIMARY KEY(experiment_id),
  INDEX USING BTREE(name),

  CONSTRAINT FOREIGN KEY (benchling_id) REFERENCES BenchlingExp(benchling_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (desc_id) REFERENCES BriefDesc(desc_id)
      ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (scientist_id) REFERENCES Scientist(scientist_id)
      ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (program_id) REFERENCES Program(program_id)
     ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (result_id) REFERENCES Results(result_id)
      ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (sop_id) REFERENCES SOP(sop_id)
      ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE = InnoDB CHARACTER SET=utf8mb4;


SELECT Experiments.name, Experiments.benchling_id, BenchlingExp.benchling_id FROM  Experiments JOIN BenchlingExp;

SELECT Experiments.name, Experiments.desc_id, BriefDesc.desc_id,
  BriefDesc.description FROM  Experiments JOIN BriefDesc;

SELECT Experiments.name, Experiments.program_id, Program.program_id,
  Program.name FROM  Experiments JOIN Program;

SELECT Experiments.name, Experiments.result_id, Results.done,
  Results.result_id FROM  Experiments JOIN Results;

SELECT Scientist.name, Scientist.department_id, Department.department_id,
  Department.name FROM  Scientist JOIN Department;

  SELECT  Experiments.experiment_id, Experiments.name, SOP.name,
  SOP.sop_id FROM Experiments JOIN SOP ;


SELECT  Experiments.name, Experiments.experiment_id, Scientist.scientist_id,
Scientist.name FROM Experiments JOIN Scientist ;


  SELECT  Experiments.name, Experiments.experiment_id, Department.department_id,
Department.name FROM Experiments JOIN Department ;

INSERT INTO Department(name) VALUES ('Molecular Biology');
INSERT INTO Department(name) VALUES('Bioinformatics');
INSERT INTO Department(name) VALUES('Synthetic Biology');

  INSERT INTO Scientist(name, manager, department_id) VALUES ('Katherine Jarvis', 'Ricardo',2);
  INSERT INTO Scientist(name, manager, department_id) VALUES('Sari','Josh Kelley', 1);
  INSERT INTO Scientist(name, manager, department_id) VALUES('Charlie','Jin', 3);

  

  INSERT INTO SOP(name) VALUES ('Single Cell Sequencing - K562');
  INSERT INTO SOP(name) VALUES('Standard Assembly');
  INSERT INTO SOP(name) VALUES ('Western Blot');

  INSERT INTO Benchlingexp(benchlingexp_id) VALUES ('EXP00000012334');
   INSERT INTO Benchlingexp(benchlingexp_id) VALUES ('EXP00000084628');
   INSERT INTO Benchlingexp(benchlingexp_id) VALUES ('EXP00000001739');


    INSERT INTO BriefDesc(description, fulldesc) VALUES ('48 hr post transfection singlecellsequencing',
    '10X Single Cell sequencing constructs 1399,1407 and 1409 48hr post transfection of K562 cells. These constructs
       compare have promoters and we hope to see if it effects their chromatin');
    INSERT INTO BriefDesc(description, fulldesc) VALUES
    ('Standard assembly of constructs 1472-1480','These constructs tests the
      nuclearization signal to test expression, negative control: 1472 scramble.
      All constant length and GFP reporter');
    INSERT INTO BriefDesc(description, fulldesc) VALUES ('Western Blot iRPE 72 hr posttransfection CBS','72 posttranfection of irpe cells
     testing different CBS to test expression, constructs 1324-1331, all GFP reporters,
     used GFP probe with Actin probe as control probe');


     INSERT INTO Program(name) VALUES ('CEP280');
     INSERT INTO Program(name) VALUES ('LAST1');


     INSERT INTO Results(done) VALUES (0);
     INSERT INTO Results(done,DriveLocation) VALUES (1, 'experiments/Bioinformatics/sequencing/230316');
     INSERT INTO Results(done,DriveLocation) VALUES (1, 'experiments/MB/assembly/1472_1480');



  INSERT INTO Experiments( name, benchling_id, desc_id, scientist_id, program_id,
   date, result_id, sop_id)
     VALUES ('SC 48hr Promoter', 1, 1, 1,1, 220924,2,1);
  INSERT INTO Experiments( name, benchling_id, desc_id, scientist_id, program_id,
     date, result_id, sop_id)
       VALUES ('Assembly 1472-1480', 2, 2, 3,1, 220912,3,2);
  INSERT INTO Experiments( name, benchling_id, desc_id, scientist_id, program_id,
       date, result_id, sop_id)
         VALUES ('Western CBS', 3, 3, 2,2, 221001,1,3);
