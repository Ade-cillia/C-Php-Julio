#include <stdio.h>
#include <string.h>
#include <stdbool.h>
#include <stdlib.h>

float sum(float arr[],int n) //Do the sum of an array of float
{
    float sumResult = 0;
    for(int i=1; i <= n; i++)
    {
        sumResult += arr[i];
    }
    return sumResult;
}
void average(int numberStudent,float noteArr[numberStudent][50],int numberNotesArr[],char nameArr[numberStudent][50]) // do average for each student and generalAverage And stock it in file
{
    int numberStudentValidate=0;
    float averageArr[numberStudent];
    float generalAverage;
    FILE *fileStorage;
    fileStorage = fopen("average.txt", "w"); //open file if exist or create one

    for(int i=1; i <= numberStudent; i++)
    {
        if(numberNotesArr[i] == 0)
        {
            printf("Moyenne de l'eleve [%i][%s] : Aucunne note saisie\n",i,nameArr[i]);
            fprintf(fileStorage,"Note(s) de l'eleve [Index:%i][Prénom:%s][Nombre de notes:%i] : Aucune note n'a ete saisie ",i,nameArr[i],numberNotesArr[i]);
        }else
        {
            numberStudentValidate++;
            averageArr[i] = sum(noteArr[i],numberNotesArr[i])/numberNotesArr[i]; //do the averageNote
            printf("Moyenne de l'eleve [%i][%s] : %.2f\n",i,nameArr[i],averageArr[i]);

            //stock in note and average in file
            fprintf(fileStorage,"Note(s) de l'eleve [Index:%i][Prénom:%s][Nombre de notes:%i] : | ",i,nameArr[i],numberNotesArr[i]);
            for(int j=1; j<=numberNotesArr[i];j++)
            {
                fprintf(fileStorage,"%.2f | ",noteArr[i][j]); // show all note
            }
            fprintf(fileStorage,"\nMoyenne de l'eleve [Index:%i][Prénom:%s] : %.2f\n\n",i,nameArr[i],averageArr[i]);
        }

    }
    if(numberStudentValidate == 0){
        printf("Aucunne note d'etudiant n'est valide\n");
        return;
    }
    // Do General Average
    generalAverage = sum(averageArr,numberStudentValidate)/numberStudentValidate;
    printf("Moyenne generale : %.2f\n",generalAverage);

    //write in file
    fprintf(fileStorage,"Moyenne generale : %.2f\n",generalAverage);
    fclose(fileStorage); // stop the write file
    return;
}
int main()
{
    // Init var
    float note;
    int numberStudent;

    printf(" Entrez le nombre d'eleve : ");
    scanf("%i",&numberStudent);
    if (numberStudent <= 0)
    {
        printf(" Nombre d'eleve invalide\n");
        return;
    }

    float noteArr[numberStudent][50];
    int numberNotesArr[numberStudent]; // index 1 = students 1 etc..
    char nameArr[numberStudent][50]; // idem



    // For each student, ask a name and notes and place it in respective array
    for(int i=1; i<=numberStudent;i++) //i= index student
    {
        bool askNote = true;
        int j=1; //index note
        printf(" Entrez le nom de l'eleve [%i]: ",i);
        scanf("%s",nameArr[i]);
        printf(" (pour stoper l'entrer de note, saisissez un nombre negatif) \n");
        printf(" Entrez les notes pour l'eleve %i:\n",i);

        do // while user don't put a negative number you can add another note for actual student(i)
        {
            printf(" Note[%i]: ",j);
            scanf("%f",&note);

            if(note < 0) //negative note stop while
            {
                noteArr[i][j] = -1;
                askNote = false;
            }else
            {
                noteArr[i][j] = note;
                j++;
            }
        }while(askNote);
        numberNotesArr[i] = j-1; //-1 because start at one
    }
    average(numberStudent,noteArr,numberNotesArr,nameArr); // do average for each student and generalAverage And stock it in file

    printf("End");
    return 0;
}
