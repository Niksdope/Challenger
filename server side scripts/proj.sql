-- Implementing a 1 : 1 relationship
Drop Database if exists Project;
Create Database Project default CHARACTER SET = utf8 default COLLATE = utf8_general_ci;
Use Project;
-- Documentation 13.1.17.3 version 5.6
-- Section 14.5.6  version 5.6

-- The parent and child tables must use the same storage engine
-- Foreign key columns and Primary key column must be exactly the same

-- RESTRICT Rejects the delete or update operation for the parent table
Create Table Challenges
(
	id Int(4) unsigned auto_increment,
    challenge varchar(60) not null,
	Primary key (id)
) engine = INNODB;

insert into Challenges values ('', 'Walk for 30 minutes');
insert into Challenges values ('', 'Walk for a kilometer');
insert into Challenges values ('', 'Do 20 push-ups');
insert into Challenges values ('', 'Share a story with someone');
insert into Challenges values ('', 'Go for a bike ride for 30 minutes and see how far you get');
insert into Challenges values ('', 'Talk to a stranger');
insert into Challenges values ('', 'Read some new discovery in science');
insert into Challenges values ('', 'Read a book');
insert into Challenges values ('', 'Clean your room');
insert into Challenges values ('', 'Wash the dishes');
insert into Challenges values ('', 'Try a new recipe');
insert into Challenges values ('', 'Do laundry');
insert into Challenges values ('', 'Take a picture');
insert into Challenges values ('', 'Reflect on what happened yesterday');
insert into Challenges values ('', 'Practice self compassion');
insert into Challenges values ('', 'Avoid a bad habit');
insert into Challenges values ('', 'Draw something');
insert into Challenges values ('', 'Watch a documentary');
insert into Challenges values ('', 'Watch a movie');
insert into Challenges values ('', 'Make someone smile');
insert into Challenges values ('', 'Invent a joke');
insert into Challenges values ('', 'Thank someone');
insert into Challenges values ('', 'Dance for 10 minutes');
insert into Challenges values ('', 'Take a new route somewhere');
insert into Challenges values ('', 'Learn something about another country');
insert into Challenges values ('', 'Ask for feedback on your work');
insert into Challenges values ('', 'Write down your fears');
insert into Challenges values ('', 'Listen to a podcast');
insert into Challenges values ('', 'Write down your values');
insert into Challenges values ('', 'Write down 10 goals for today');
insert into Challenges values ('', 'Do something new');
insert into Challenges values ('', 'Write a letter to your past self');
insert into Challenges values ('', 'Eliminate a distraction from your environment');
insert into Challenges values ('', 'Treat yourself');
insert into Challenges values ('', 'Write down what you want to improve upon');
insert into Challenges values ('', 'Teach someone');
insert into Challenges values ('', 'Add something new to your routine');
insert into Challenges values ('', 'Wake up early');
insert into Challenges values ('', 'Write a letter to your future self');
insert into Challenges values ('', 'Step out of your comfort zone');
insert into Challenges values ('', 'Give someone a challenge');
insert into Challenges values ('', 'Avoid negative people');
insert into Challenges values ('', 'Spend less time on distractions');
insert into Challenges values ('', 'Do not watch TV');
insert into Challenges values ('', 'Meditate for 10 minutes');
insert into Challenges values ('', 'Take a break from work');
insert into Challenges values ('', 'Give a compliment');
insert into Challenges values ('', 'Add a diary entry');
insert into Challenges values ('', 'Write down what you dreamt about');
insert into Challenges values ('', 'Listen to a new song');
insert into Challenges values ('', 'Be completely honest');
insert into Challenges values ('', 'Drink at least a liter of water');
insert into Challenges values ('', 'Do 40 sit-ups');
insert into Challenges values ('', 'Cycle somewhere');
insert into Challenges values ('', 'Write down 10 things you are grateful for');
insert into Challenges values ('', 'Reflect on something good that happened to you today');
insert into Challenges values ('', 'Watch a funny video');
insert into Challenges values ('', 'Listen to your favourite song');
insert into Challenges values ('', 'Have some green tea');
insert into Challenges values ('', 'Avoid being negative today');
insert into Challenges values ('', 'Eat some fruit/veg');
insert into Challenges values ('', 'Research something you find interesting');
insert into Challenges values ('', 'Write a story with atleast 600 words');
insert into Challenges values ('', 'Criticize your own work');
insert into Challenges values ('', 'Wear something different today');
insert into Challenges values ('', 'Learn a magic trick');
insert into Challenges values ('', 'Practice yoga for 15 minutes');
insert into Challenges values ('', 'Tell someone why they are important to you');
insert into Challenges values ('', 'Say yes to something different');
insert into Challenges values ('', 'Bring your own food to work/school');
insert into Challenges values ('', 'Instead of smoking go outside and take deep breaths');
insert into Challenges values ('', 'Research a different religion or culture');
insert into Challenges values ('', 'Listen to something inspirational');
insert into Challenges values ('', 'Read about some event in history');
insert into Challenges values ('', 'Learn a new word');
insert into Challenges values ('', 'Spend 30-60 minutes practicing a new language');
insert into Challenges values ('', 'Learn how to lucid dream');
insert into Challenges values ('', 'Do an act of kindness');
insert into Challenges values ('', 'Try out polyphasic sleep (multiple times a day)');
insert into Challenges values ('', 'Do a brain puzzle (crosswords/sudoku/etc.)');

Create Table Users
(
    email varchar(80) not null,
    password varchar (64) not null,
    type varchar(10),
    challenges varchar (40),
    recent varchar (40),
    completed int (6),
    total int (7),
    Primary key (email)
) engine = INNODB;

insert into Users values ('niksdope@hotmail.com', 'shalle', 'admin', '1,2,3,4,5,6,7,8,9,10', '1,2,3,4,5,6,7,8,9,10', '10', '10');