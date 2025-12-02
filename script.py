# script.py
import os

user = os.getenv("USER_NAME", "GitHub User")  # domyślna wartość, jeśli zmienna nie jest ustawiona
print(f"Hello, {user}! This is your workflow speaking.")
