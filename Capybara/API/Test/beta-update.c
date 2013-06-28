#include <stddef.h>
#include <stdlib.h>
#include <unistd.h>
int main(void)
{
    execl("/usr/local/bin/svn", "svn", "--username", "pal", "--password", "Bangura28!", "--trust-server-cert", "--non-interactive", "update", "/www/rodentia.se/beta/",
    (const char *) NULL);
    return(EXIT_FAILURE);
}

