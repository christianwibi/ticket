create database db_detikcom;
 
use db_detikcom;
 
DROP TABLE IF EXISTS events;

CREATE TABLE events (
  event_id int(11) NOT NULL auto_increment,
  name varchar(100) NOT NULL,
  date_start date NOT NULL,
  date_end date NOT NULL,
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at datetime,
  PRIMARY KEY (event_id)
);

CREATE INDEX events_idx ON events(event_id);

DROP TABLE IF EXISTS tickets;

CREATE TABLE tickets (
  ticket_id int(11) NOT NULL auto_increment,
  event_id int(11) NOT NULL,
  ticket_code varchar(10) NOT NULL UNIQUE,
  status enum('available','claimed') NOT NULL DEFAULT 'available',
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at datetime,
  PRIMARY KEY (ticket_id),
  FOREIGN KEY (event_id) REFERENCES events(event_id)
);

insert into events(name,date_start,date_end) values
('konser gigi','2011-11-01','2011-11-01'),
('iims 2023','2023-02-03','2023-02-26');

insert into tickets(event_id,ticket_code,status) values
('2','IIM6VHB8DM','available');