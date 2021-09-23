class Pet:
	def __init__(self, name, greeting = "Hello"):
		self.name = name
		self.greeting = greeting

	def say_hi(self):
		print(f"{self.greeting}, I'm {self.name}!")
	
	@classmethod
	def legs_count(cls):
		pass 

class Cat(Pet):
	def __init__(self, name):
		super().__init__(name, "Meow")

	@classmethod
	def legs_count(cls):
		return 4 

class Parrot(Pet):
	def __init__(self, name):
		super().__init__(name, "Okayyyy")
	
	def say_hi(self):
		print(f"{self.greeting}, my name is {self.name}!")

	@classmethod
	def legs_count(cls):
		return 2 

my_pet = Pet("Gaston")
my_pet.say_hi()

cat = Cat("Félix")
cat.say_hi()

parrot = Parrot("Koili")
parrot.say_hi()

print(Cat.legs_count())
print(Parrot.legs_count())