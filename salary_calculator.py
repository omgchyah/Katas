#Solicite al usuario las horas y la tarifa por hora y dar salario

hours = input("Por favor, introduce las horas trabajadas: ")

hours = float(hours)
    
rate = input("Indique cuánto ganas por hora: ")

rate = float(rate)

salary = hours * rate

print(f"\nSu salario total es: {salary} euros")
