#!/bin/bash

# Path to the .env file
env_file=".env"

# Function to list and select variables
select_variable() {
    local options=($(grep -E '^[A-Z_]*=' $env_file | sort))
    local selected_var

    PS3="Select a variable to change (or 'q' to quit): "
    select var in "${options[@]}" "Quit"; do
        case $var in
            "Quit")
                break
                ;;
            *)
                selected_var="$var"
                break
                ;;
        esac
    done

    if [[ -n "$selected_var" ]]; then
        echo "Selected variable: $selected_var"
        read -p "Enter new value for $selected_var: " new_value

        # Update the .env file
        sed -i "s/^$selected_var=.*/$selected_var=$new_value/" $env_file

        echo "Value updated successfully!"
    else
        echo "No variable selected. Exiting."
    fi
}

# Main script
while true; do
    echo "Current values in .env file:"
    cat $env_file | grep -E '^[A-Z_]*=' | sort

    select_variable

    read -p "Do you want to change another value? (y/n): " continue
    if [[ $continue != "y" ]]; then
        break
    fi
done

echo "Script completed."
