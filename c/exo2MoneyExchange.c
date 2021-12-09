#include <stdio.h>
#include <string.h>
#include <stdbool.h>

float askMoneyValue(char * moneyType,char * moneyTypeFinal,float exgangeRate)
{
    //printf("%s\n",moneyType);
    //printf("%s\n",moneyTypeFinal);
    //printf("%f\n",exgangeRate);

    float moneyToConvert;
    float exchangedMoney;
    printf("Entrez votre montant a convertir en %s : ", moneyTypeFinal);
    scanf("%f", &moneyToConvert);
    //printf("%f\n",moneyToConvert);
    if (!strcmp(moneyType,"euro"))
    {
        exchangedMoney = (moneyToConvert*exgangeRate);
    }
    else
    {
        exchangedMoney = (moneyToConvert/exgangeRate);
    }
    printf("Resultat: %.2f %s = %.2f %s\n\n",moneyToConvert,moneyType,exchangedMoney,moneyTypeFinal);
    return exchangedMoney;
}
float askMoneyType()
{
    char* moneyType;
    printf("Entrez votre type de monnaie (dollar ou euro) : ");
    scanf("%s", &moneyType);
    if(!strcmp(&moneyType,"dollar") || !strcmp(&moneyType, "euro"))
    {
        float exgangeRate=1.16;
        char* moneyTypeFinal;
        if (!strcmp(&moneyType,"dollar"))
        {
            moneyTypeFinal = "euro";
        }
        else
        {
            moneyTypeFinal = "dollar";
        }
        return askMoneyValue(&moneyType,moneyTypeFinal,exgangeRate);
    } else
    {
        printf("Le type de monnaie est invalide, veuillez reessayer. \n");
        return askMoneyType();
    }
}
int main(void)
{
    bool execExchange=true;
    float newSold = askMoneyType();
    do
    {
        printf("Voullez vous reessayer (oui ou non)? : ");
        scanf("%s", &execExchange);
        if (!strcmp(&execExchange,"oui"))
        {
            newSold = askMoneyType();
        }
        else if (!strcmp(&execExchange,"non"))
        {
            execExchange = false;
        }else
        {
            printf("Saisie invalide. ");
        }

    }while(execExchange);


    printf("Good-bye");
    return 0;
}
