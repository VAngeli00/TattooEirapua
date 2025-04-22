# Use an official PHP image with Apache
FROM php:8.2-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the application code into the container
# This copies everything from the current directory (.) where the Dockerfile is
# into the /var/www/html directory inside the container.
COPY . /var/www/html/

# (Optional but good practice) Ensure Apache can write if needed (e.g., for logs or uploads later)
# RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (standard HTTP port for Apache)
EXPOSE 80