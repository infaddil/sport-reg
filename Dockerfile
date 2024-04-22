FROM phpmyadmin/phpmyadmin:latest

# Set environment variables
ENV PMA_ARBITRARY 1

# Copy custom Apache config
COPY apache-config.conf /etc/apache2/conf-available/

# Enable the custom config
RUN a2enconf apache-config

# Expose port 80
EXPOSE 80
