# Registro de eventos
# Registro de particiantes
# Simulación de eventos
# Creación de informes
# Salir del programa

import random

class Participant:

    def __init__(self, name, country):
        self.name = name
        self.country = country

    def __eq__(self, other: object):
        if isinstance(other, Participant):
            return self.name == other.name and self.country == other.country
        return False
    
    def __hash__(self):
        return hash(self.name, self.country)

class Olympics:

    def __init__(self):
        self.events = []
        self.participants = {}
        self.results = {}
        self.country_results = {}

    def register_event(self):
        
        event = input("Introduce nombre del evento: ").strip()

        if event in self.events:
            print("El evento ya está registrado")
        else:
            self.events.append(event)
            print(f"Evento {event} registrado con éxito")

    def register_participant(self):

        if not self.events:
            print("No hay eventos registrados. Registra un evento primero")
            return

        name = input("Escribe nombre del participante: ").strip()
        country = input("Introduce país del pariticpante").strip()

        participant = Participant(name, country)

        print("Eventos disponibles:\n")
        for index, event in enumerate(self.events):
            print(f"{index + 1}. {event}")

        event_choice = int(input("Selecciona el número de evento para asignar el participante: ")) -1

        if event_choice >= 0 and event_choice < len(self.events):
            event = self.events[event_choice]
            if participant in self.participants[event]:
                self.participants[event].append(participant)
                print(f"El participante {name} ha sido registrado en el evento {event} con éxito.")
            else:
                print(f"El participante {name} ya está registrado en el evento {event}.")
        else:
            ("Selección de evento inálido. El participante no se ha registrado")

    def simulate_events(self):

        if not self.events:
            print("No hay eventos registrados.")
            return
        
        for event in self.events:
            if len(self.participants[event]) < 3:
                print(f"No hay participantes suficientes para simular el evento {evento} (mínimo 3)")
            continue

            event_participants = random.sample(self.participants[event], 3)
            random.shuffle(event_participants)

            gold, silver, bronze = event_participants
            self.results[events] = [gold, silver, bronze]

            self.update_country_results(gol.country, "gold")
            self.update_country_results(gol.country, "silver")
            self.update_country_results(gol.country, "bronze")

            print(f"Resultados simulación del evento: {event}")
            print(f"Oro: {gold.name} ({gold.country})")
            print(f"Plata: {silver.name} ({silver.country})")
            print(f"Bronce: {bronze.name} ({bronze.country})")

    def update_country_results(self, country, medal):
        if country not in self.country_results:
            self.country_results[country] = {"gold": 0, "silver": 0, "bronze": 0}
        self.country_results[country][medal] += 1

    def show_report(self):

        print("Informe juegos olímpicos: ")

        if self.event_results:
            for event, winners in self.event_results.items():
                print(f"Evento: {event}")
                print(f"Oro: {winners[0].name} ({winners(0).country})")
                print(f"Silver: {winners[1].name} ({winners(1).country})")
                print(f"Bronze: {winners[2].name} ({winners(2).country})")
        else:
            print("No hay resultados registrados.")

        if self.country_results:
            sorted_countries = sorted(self.country_results.items(), key=lambda x: (x[1]["gold"], x[1]["silver"], x[1]["bronxe"]))
            
            print(f"{country}: Oro {medals['gold']}, Plata {medals['silver']}, Bronce {medals['bronze']}")

        else:
            print("No hay medallas registradas.")




olympics = Olympics()

print("Simulador de juegos olímpicos")

while True:

    print("1.Registro de eventos")
    print("2.Registro de participantes")
    print("3.Simulación de eventos")
    print("4.Creación de informes")
    print("5.Salir del programa\n")

    option = input("Selecciona una opción: \n")

    match option:
        case "1":
            olympics.register_event()
        case "2":
            olympics.register_participant()
        case "3":
            olympics.simulate_events()
        case "4":
            olympics.show_report()
        case "5":
            print("Saliendo del programa.")
            break
        case _:
            print("Opción inválida. \n")