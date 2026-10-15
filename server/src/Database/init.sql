CREATE TABLE nutritionists(
	id TEXT PRIMARY KEY,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  password TEXT NOT NULL,
  avatar TEXT,
  CNPJ TEXT NOT NULL
);

  CREATE TABLE patients(
    id TEXT PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    password TEXT NOT NULL,
    avatar TEXT,
    CPF TEXT NOT NULL,
    birth_date DATE,
    is_email_verified BOOLEAN
  );

CREATE TABLE events(
	id TEXT PRIMARY KEY,
  	name TEXT NOT NULL,
  	status TEXT NOT NULL,
  	event_date DATE,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  	nutrionist_id TEXT,
 	FOREIGN KEY(nutrionist_id) REFERENCES nutritionists(id)
);

CREATE TABLE meetings(
	id TEXT PRIMARY KEY,
  name TEXT NOT NULL,
  start_date DATE,
  end_date DATE,
  event_id TEXT,
  FOREIGN KEY(event_id) REFERENCES events(id)
);

CREATE TABLE attendees(
	id TEXT PRIMARY KEY,
  	patient_id TEXT,
  	host_id TEXT,
  	meeting_id TEXT,
  	FOREIGN KEY(patient_id) REFERENCES patients(id),
  	FOREIGN KEY(host_id) REFERENCES nutritionists(id),
  	FOREIGN KEY(meeting_id) REFERENCES meetings(id)
);

CREATE TABLE medical_records(
  id TEXT PRIMARY KEY,
  doc_orientation TEXT,
  doc_meal_plain TEXT,
  doc_prescription TEXT,
  doc_supplementation TEXT,
  meeting_id TEXT,
  patient_id TEXT,
  nutritionist_id TEXT,
  FOREIGN KEY(patient_id) REFERENCES patients(id),
  FOREIGN KEY(nutritionist_id) REFERENCES nutritionists(id),
  FOREIGN KEY(meeting_id) REFERENCES meetings(id)
);

CREATE TABLE conducts(
	id TEXT PRIMARY KEY,
  	text TEXT,
  	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  	meeting_id TEXT,
    patient_id TEXT,
    nutritionist_id TEXT,
    FOREIGN KEY(patient_id) REFERENCES patients(id),
  	FOREIGN KEY(nutritionist_id) REFERENCES nutritionists(id),
  	FOREIGN KEY(meeting_id) REFERENCES meetings(id)
);

CREATE TABLE contents(
	id TEXT PRIMARY KEY,
  doc TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  medical_record_id TEXT,
  nutritionist_id TEXT,
  FOREIGN KEY(medical_record_id) REFERENCES medical_records(id),
  FOREIGN KEY(nutritionist_id) REFERENCES nutritionists(id)
);

CREATE TABLE meal_plans(
	id TEXT PRIMARY KEY,
  title TEXT NOT NULL,
  plate_image TEXT NOT NULL,
  plate_description TEXT,
  rate INTEGER,
  hungry_level INTEGER,
  satiety_level INTEGER,
  post_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  patient_id TEXT,
  nutritionist_id TEXT,
  FOREIGN KEY(patient_id) REFERENCES patients(id),
  FOREIGN KEY(nutritionist_id) REFERENCES nutritionists(id)
);

CREATE TABLE chat(
	id TEXT PRIMARY KEY,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  patient_id TEXT,
  nutritionist_id TEXT,
  FOREIGN KEY(patient_id) REFERENCES patients(id),
  FOREIGN KEY(nutritionist_id) REFERENCES nutritionists(id)
);

CREATE TABLE patient_message(
  id TEXT PRIMARY KEY,
  text TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  patient_id TEXT,
  chat_id TEXT,
  FOREIGN KEY(patient_id) REFERENCES patients(id),
  FOREIGN KEY(chat_id) REFERENCES chat(id)
);

CREATE TABLE nutrionist_message(
  id TEXT PRIMARY KEY,
  text TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  nutritionist_id TEXT,
  chat_id TEXT,
  FOREIGN KEY(nutritionist_id) REFERENCES nutritionists(id),
  FOREIGN KEY(chat_id) REFERENCES chat(id)
);

CREATE TABLE notifications(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  type TEXT NOT NULL,
  message TEXT NOT NULL,
  read BOOLEAN
);

CREATE TRIGGER after_patient_insert
AFTER INSERT ON patients
BEGIN 
  INSERT INTO notifications (type, message, read)
  VALUES (
    'ACEITO',
    'A paciente ' || NEW.name || ' aceitou sua convite',
    0
  );
END;