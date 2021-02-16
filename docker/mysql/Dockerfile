FROM centos/mariadb-102-centos7:latest
LABEL maintainer="Ionut Grecu <ionut@grecu.eu>"

USER root

RUN yum install nano -y -q
ADD ./src/run-mysqld /usr/bin/run-mysqld
RUN chmod 0755 /usr/bin/run-mysqld

ADD src/my.cnf  /etc/my.cnf
RUN chmod 0755 /etc/my.cnf
# RUN sed -i -e "s/^server-id =.*$/server-id = ${MYSQL_SERVER_ID}/g" -e "s/^auto_increment_increment =.*$/auto_increment_increment = ${MYSQL_AUTO_INCREMENT_INCREMENT}/g" -e "s/^auto_increment_offset =.*$/auto_increment_offset = ${MYSQL_AUTO_INCREMENT_OFFSET}/g" /etc/my.cnf

WORKDIR /

EXPOSE 3601:3306

USER mysql

# CMD ["/bin/sh","startup.sh"]
CMD ["/bin/sh","run-mysqld"]
