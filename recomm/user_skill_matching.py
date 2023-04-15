import requests
from deep_translator import GoogleTranslator


## Top- Profession
top_jobs_skills = {"Cybersecurity": ["Firewall-Sicherheitssystem", "Methoden Informationssicherheit", "Verschlüsselung", "Security Incident Handling and Response", "Virtual Private Networks"] , "Data Management" : ["Automatisierte Messung", "Management Datenqualität", "Datenbanken- & Stammdatenmanagement (SQL, Data Hub)", "Datenverarbeitung (EDV)"], "Data Science & KI": ["Big Data Analytics", "Deep Learning (Neuronale Netzwerke)", "Machine Learning Technologien ", "Scikit-Learn, Tensorflow, Keras, PyTorch, Python"], "Design": ["Mensch-Maschine-Interaktion and Design Nutzerschnittstellen", "UI / UX / Interaction Design (Adobe XD)", "Webfrontend-Entwicklung (CSS)", "Visualisierung (Illustrator)"], "Alternative Antriebstechnologien": ["Batterieentwicklung (High Voltage Battery)", "E-Fuels", "Elektrische Antriebsstrangentwicklung ", "(E-Achsen, Siliziumkarbid-Halbleiter)", "Elektrische Motormanagementsysteme (EMS)", "Energiespeicherung (Lithium-Ionen-Technik)", "Wasserstoff / Brennstoffzelle"], "Analytische Chemie": ["Materialanalyse ((Infrarot-)Spektroskopie)", "Qualitätsmanagement in der chemischen Industrie (CAPA)"], "Assistiertes & autonomes Fahren": ["Datenvorgaben und Verarbeitung (insb. GPS-Daten)", "Entwicklung von Fahrerassistenzsystemen (Objekterkennung)", "Funktionale Sicherheit (IEC, ISO, 8D)", "Rechtliche Vorgaben", "Standardisierung der Softwarearchitektur von Fahrzeugen (AutoSAR)", "Vernetzung (3D Navigationslandschaft, Unfälle in Echtzeit weitergeben)"], "Biotechnologie": ["Biochemische Analyse (Chromatographie)", "Genome Editing (CRISPR)", "Molekularbiologische Techniken (In Vitro)", "Zellkultivierung"], "Electrical Engineering": ["Digitale Elektronik (Digitale Schaltungstechnik, ASIC)", "Industrierobotik (Störungsanalyse)", "Laserscanning (LIDAR)", "Leistungsoptimierung (EDA)", "Mikrotechnologie (Custom Chip)"], "Industrial Engineering": ["Automatisierung (Programmable Logic Controller, Robotic Process Automation, automatische Bestückung)", "High Performance Plastic Maintenance (Preventive / Predictive Maintenance)", "Mensch-Maschine-Interaktion und Integration", "Simulation & Digitaler Zwilling", "Technisches Zeichnen und Konstruieren (CAD, Design for Manufacturing and Assembly, 3D Druck, BIM)"], "Grundlegende IT-Fähigkeiten": ["Anwendungssysteme (Microsoft Office)", "Betriebssysteme (Microsoft Windows)", "Datenschutz (DSGVO)"], "Problemlösungsfähigkeit": ["Koordinationsfähigkeit","Lösungsorientierung", "Strukurierung & Konzeptionalisierung"]}

print(top_jobs_skills.keys())


def intersection_skills(user_skills, job_profile):
    return len(list(set(user_skills) & set(top_jobs_skills[job_profile])))/len(top_jobs_skills[job_profile])

print(intersection_skills(["Firewall-Sicherheitssystem", "Methoden Informationssicherheit", "Verschlüsselung"], "Cybersecurity"))






# r = requests.get("https://rest.arbeitsagentur.de/jobboerse/jobsuche-service/pc/v4/jobs?was=Softwareentwickler&wo=baden württemberg&berufsfeld=Informatik&&behinderung=false&corrona=false&umkreis=200")

# print(r.status_code)

# print(r.json()["stellenangebote"])



# text = """We are searching for a deadline-driven painter with great attention to detail. The painter will be expected to use color theory principles to match shades, follow written and verbal instructions, and use a variety of tools to paint surfaces. Other responsibilities include completing minor repairs and selecting correct paints and primers.

# To be successful as a painter, you should have great stamina, physical strength, and time management skills. The ideal candidate will be able to understand clients’ visions, follow directions, and complete projects on time and to budget. Selecting the correct tools and paints for projects. Preparing walls and other surfaces before painting. Mixing and applying paints, varnishes, and sealants for a lasting finish. Covering exposed objects and surfaces.

# Using fillers such as putty and plaster to repair cracks. Buying paint, brushes, and other supplies. Obeying workplace safety rules. Collaborating with other design and construction specialists. Keeping the workspace and tools clean."""


# users = [{"name": "A", "profession": "painter", "description": "I am having 2 years of experience as a painter at XYZ comoany. I know very well how to mix and apply paints. preparing walls before painting", "work experience": "2 years"}, {}]

