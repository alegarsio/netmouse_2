#include<stdio.h>
#include<stdlib.h>
#include<stdint.h>
#include<ctype.h>
#include<string.h>
#include<time.h>

#if defined(_WIN32) || defined(_WIN64)
    #include<windows.h>
#elif defined(__linux__)
    #include<unistd.h>
#endif

    // Architecture Preprocessor Exception 

    #ifdef __x86_64__
        #define ARCH_64_BIT
    #elif __arm__
        #define __ARM_ARCH_7A__ 
    #elif __i386__
        #define ARCH_32_BIT
    #endif

    // OS Bits [WIN]

    #if defined(_WIN64)
        #define WINDOWS_64
    #elif defined(_WIN32)
        #define WINDOWS_32
    #endif

typedef struct 
{
    char buffer_register[13];

}INFORMATION;

struct REGISTER 
{
        unsigned int eax;
        unsigned int ebx;
        unsigned int ecx;
        unsigned int edx;
};
class CPU{   

    private:
    
    REGISTER *node = (REGISTER*)malloc(sizeof(REGISTER));

    static inline char *alert;

    uint32_t scn_counter(void){
        struct timespec td;
        clock_gettime(CLOCK_MONOTONIC, &td);
        return (uint32_t) (td.tv_sec * 1000 + td.tv_nsec / 1000000);
    }
    
    public:

    CPU() : node(new REGISTER) {}

    char *OSBIT(){
        char *id = (char*)malloc(sizeof(char) * 12);
        #ifdef WINDOWS_64  
            strcpy(id,"64 BIT");
        #elif WINDOWS_32 
            strcpy(id ,"32 BIT")
        #endif
        return id;
    }
    char *OSID(){
        static char *id = (char*)malloc(sizeof(char) + 20);

        #if defined(_WIN32) || (_WIN64)
            strcpy(id , "Windows");
        #elif defined(__linux__)
            strcpy(id , "Linux");
        #endif

        return id;

    }
    int OSBIT_INTOI(){

        int id ;

        if (strcmp(OSBIT(),"64 BIT") == 0){
            id = 64;
        }
        else if (strcmp(OSBIT(),"32 BIT") == 0){
            id = 32;
        }
        return id;
    }
    int CORES() {

    static int num_cores;

    asm volatile(
        "mov $1, %%eax\n"        
        "cpuid\n"                
        "mov %%ebx, %0\n"         
        : "=r" (num_cores)        
        :                         
        : "%eax", "%ebx", "%ecx", "%edx"  
    );
    num_cores = (num_cores >> 26) + 1;

    return num_cores;
}
    INFORMATION MODEL(){

        unsigned int eax;
        unsigned int ebx;
        unsigned int ecx;
        unsigned int edx;
       
        asm volatile(
            "cpuid"
            :"=b"(ebx),"=d"(edx),"=c"(ecx)
            : "a"(eax)
        );

        INFORMATION info;
        *(unsigned int*)info.buffer_register = ebx;
        *((unsigned int*)info.buffer_register + 1) = edx;
        *((unsigned int*)info.buffer_register + 2) = ecx;

        info.buffer_register[12] = '\0';

        return info;

    }

    uint64_t READTIMESTAMP(){

        uint32_t low , high;

        uint64_t r32;

        #ifdef ARCH_64_BIT
            asm volatile(
                "rdtsc"
                : "=a"(low),"=d"(high)
            );

            return ((uint64_t) high << 32) | low;
        #elif ARCH_32_BIT
            asm volatile(
                "rdtsc"
                :"=A"(r32)
            );

            return r32;

        #endif

    }
    int SPEEDFRQ(void){
        const uint64_t cycounter = READTIMESTAMP();
        const uint32_t mili = scn_counter();
        int last = 0;

        for (;;)
        {
            int n = 1000000;
            while(--n > 0) {}

            const uint32_t militotal = scn_counter() - mili;
            const uint64_t ncycle = READTIMESTAMP();

            if (militotal > 80){
                const int result = (int) (((ncycle - cycounter)/militotal) / 1000);
                if (militotal > 500 || (last == result && result > 100)){
                    return result;
                }
                last = result;
            }
        }
    }
    int CORE(){

        static int core_;

        asm volatile(
            "movl %1 , %%eax\n"
            "cpuid\n"
            "movl %%ebx, %0\n"
            :"=r"(core_)
            :
            :"%eax","ebx","ecx","edx"
        );

        core_ = (core_ >> 26) + 1;

        return core_;

    }
    char *ARCH(){

        char *ptr_buffer = (char*)malloc(sizeof(char) * 50);

        #ifdef ARCH_64_BIT
            strcpy(ptr_buffer , "x64");
        #elif ARCH_32_BIT
            strcpy(ptr_buffer , "X32");
        #endif

        if (ptr_buffer == NULL){
            perror("Memory allocation failed");
        }

        free(ptr_buffer);

        return ptr_buffer;
    }
    ~CPU(){
        delete node;
    }
};
class SYS{
    public :
    char *HOSTNAME(){

        #if defined(_WIN32)||defined(_WIN64)

        static char buffer[256];
        DWORD size = sizeof(buffer);
        if (!GetComputerName(buffer , &size)){
            perror("Failed to alocate the Memory");
            return NULL ; // we are using pointer return 
        }
        return buffer;

        #elif defined(__linux__)
        static char linux_buffer[256];
        if (gethostname(linux_buffer , sizeof(linux_buffer)) != 0){
            perror("Error Getting information"); 
            return NULL;
            }
        return linux_buffer;
        

        #endif
    }
};
