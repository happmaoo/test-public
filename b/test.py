import tkinter as tk
from tkinter import messagebox

def show_message():
    text = entry.get()
    messagebox.showinfo("Message", text)

root = tk.Tk()
root.title("Sample GUI")

entry = tk.Entry(root)
entry.pack()

button = tk.Button(root, text="确定", command=show_message)
button.pack()

root.mainloop()
