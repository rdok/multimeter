import sys


def print_times(user_input, times):
    output = user_input * times
    print(output)


print_times(sys.argv[1], int(sys.argv[2]))
